<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TargetResource;
use App\Models\Target;
use App\Models\TargetRemark;
use App\Models\User;
use App\Notifications\TargetApprovalNotification;
use App\Notifications\TargetApproveNotification;
use App\Notifications\TargetRejectNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function targetIndex(Request $request) {
        $user = Auth::user();

        $relations = [
            'year',
            'parameter.perspective',
            'parameter.strategic_target',
            'parameter.kondisi',
            'parameter.type_ytd',
            'parameter.evidence',
            'remark'
        ];

        $target = Target::with($relations);

        $target->whereTargetYearId($request->year_id);

        switch ($user->role_id) {
            case 1:
                $target->whereUnitId($request->unit_id);
                break;
                    
            case 2:
                // $target->whereIn('status', [1,2]);

                $target->whereIn('unit_id', function ($query) use ($user) {
                    $query->select('id')->from('users')->whereAtasan($user->id);
                });
                break;

            case 3:
            case 4:
                $target->whereUnitId($user->id);
                $target->orWhere('created_by', $user->id);
                break;
        }

        $target = $target->get();

        $subtarget = Target::with($relations);
        $subtarget->where('target_year_id', $request->year_id);

        $subtarget->whereIn('parent_id', $target->pluck('id')->toArray());

        switch ($user->role_id) {
            case 1:
                $subtarget->whereUnitId($request->unit_id);
                break;
                    
            case 2:
                //$subtarget->whereIn('status', [1,2]);

                $subtarget->whereIn('unit_id', function ($query) use ($user) {
                    $query->select('id')->from('users')->whereAtasan($user->id);
                });
                break;

            case 3:
            case 4:
                $subtarget->whereUnitId($user->id);
                $subtarget->orWhere('created_by', $user->id);
                break;
        }

        $subtarget = $subtarget->get();

        return $target->merge($subtarget);
    }

    public function index(Request $request)
    {
        try {
            $targets = $this->targetIndex($request);

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['targets'] = TargetResource::collection($targets);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * own update or create method
     * 
     * @var int   $id
     * @var array $check_columns
     */
    private static function updateOrCreate($id, $columns) {
        $target = Target::find($id);
        
        /**
         * jika data ditemukan lakukan update
         * jika tidak lakukan create
         */
        if (!empty($target)) {
            /**
             * abaikan update jika data dalam kondisi
             * 1 = pending
             * 2 = approved
             */
            if (!in_array($target->status, [1,2])) {
                $target->update($columns);
            }
        } else {
            $target = Target::create($columns);
        }

        return $target;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            switch ($request->user()->role_id) {
                case 2:
                    $this->responseCode = 403;
                    $this->responseMessage = 'Approver tidak dizinkan untuk membuat atau memperbarui target.';
        
                    return response()->json($this->getResponse(), $this->responseCode);
                
                case 4:
                    if (!empty($request->input('targets.*.subtargets.*'))) {
                        $this->responseCode = 403;
                        $this->responseMessage = 'Unit tidak dizinkan untuk menerapkan ke unit dengan parameter yg sama.';
            
                        return response()->json($this->getResponse(), $this->responseCode);
                    }
            }
    
            $rules = [
                'send' => 'boolean',
                'year_id' => 'required|exists:App\Models\TargetYear,id,deleted_at,NULL',
                'targets' => 'array',
                // 'targets.*.parent_id' => 'exists:App\Models\Target,id,deleted_at,NULL',
                'targets.*.parameter_id' => 'required|exists:App\Models\MasterParameter,id,deleted_at,NULL',
                'targets.*.unit_id' => [
                    Rule::requiredIf(
                        in_array(
                            Auth::user()->role_id,
                            [1,3]
                        )
                    ),
                    'exists:App\Models\User,id,deleted_at,NULL'
                ],
                'targets.*.pic' => 'required',
                'targets.*.target' => 'required|numeric',
                'targets.*.bobot' => 'required|numeric',
                'targets.*.subtargets' => 'sometimes|required|array',
                'targets.*.subtargets.*.unit_id' => 'required|exists:App\Models\User,id,deleted_at,NULL',
                'targets.*.subtargets.*.target' => 'required|numeric',
                'targets.*.subtargets.*.bobot' => 'required|numeric',
            ];
    
            $messages = [
                'regex' => ':attribute hanya boleh berisi huruf dan spasi.',
                'exists' => ':attribute tidak tersedia.',
                'required' => ':attribute wajib diisi.',
                'numeric' => ':attribute berupa angka.',
            ];
    
            $attributes = [
                'year_id' => 'Tahun',
                'targets' => 'Target',
                'targets.*.parent_id' => 'Pusat',
                'targets.*.parameter_id' => 'Parameter',
                'targets.*.unit_id' => 'Unit',
                'targets.*.pic' => 'PIC',
                'targets.*.target' => 'Target',
                'targets.*.bobot' => 'Bobot',
                'targets.*.subtargets.*.unit_id' => 'Unit',
                'targets.*.subtargets.*.target' => 'Target',
                'targets.*.subtargets.*.bobot' => 'Bobot',
            ];
    
            $validator = Validator::make($request->all(), $rules, $messages, $attributes);
    
            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();
    
                return response()->json($this->getResponse(), $this->responseCode);
            }

            $data = collect();
            $send = !empty($request->send) ? 1 : 0;
            
            foreach ($request->targets ?? [] as $value) {
                switch ($request->user()->role_id) {
                    case 4:
                        $value['unit_id'] = $request->user()->id;
                        break;
                }

                $value['id'] = !empty($value['id']) ? $value['id'] : null;
                $value['parent_id'] = !empty($value['parent_id']) ? $value['id'] : null;

                $target = self::updateOrCreate($value['id'], [
                    'parent_id' => $value['parent_id'],
                    'target_year_id' => $request->year_id,
                    'parameter_id' => $value['parameter_id'],
                    'unit_id' => $value['unit_id'],
                    'pic' => $value['pic'],
                    'target' => $value['target'],
                    'bobot' => $value['bobot'],
                    'status' => $send
                ]);
                
                $subtargets = [];

                foreach ($value['subtargets'] ?? [] as $subvalue) {
                    $subvalue['id'] = !empty($subvalue['id']) ? $subvalue['id'] : null;

                    $subtargets[] = self::updateOrCreate($subvalue['id'], [
                        'parent_id' => $target->id,
                        'target_year_id' => $request->year_id,
                        'parameter_id' => $subvalue['parameter_id'],
                        'unit_id' => $subvalue['unit_id'],
                        'pic' => $subvalue['pic'],
                        'target' => $subvalue['target'],
                        'bobot' => $subvalue['bobot'],
                        'status' => $send
                    ]);
                }

                $target['subtargets'] = $subtargets;
                $data->push($target);
            }

            $deletedTargetIds = $request->input('deleted_targets.*') ?? [];
            $deletedTargets = Target::whereIn('id', $deletedTargetIds);
            $deletedTargets->orWhereIn('parent_id', function ($query) use ($deletedTargetIds) {
                $query->select('id')->from('targets')->whereIn('id', $deletedTargetIds);
            });
            $deletedTargets = $deletedTargets->get();

            foreach ($deletedTargets as $deletedTarget) {
                $deletedTarget->delete();
            }

            DB::commit();

            // if ($isSend) {
            //     Notification::send(
            //         User::find($target->pluck('created_by')),
            //         new TargetApprovalNotification()
            //     );
            // }

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan.';
            
            $this->responseData['targets'] = TargetResource::collection($data);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            DB::rollBack();

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Target  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $rules = [
                'targets' => 'required|array',
                'targets.*.id' => 'required|exists:App\Models\Target,id,deleted_at,NULL'
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.'
            ];

            $attributes = [
                'targets' => 'Target',
                'targets.*.id' => 'Target',
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Request tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $targets = Target::whereIn('id', $request->input('targets.*.id'));

            if (empty($targets->count())) {
                $this->responseCode = 404;
                $this->responseMessage = 'Data tidak ditemukan';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $resource = $targets->with([
                'year',
                'parameter.perspective',
                'parameter.strategic_target',
                'parameter.kondisi',
                'parameter.type_ytd',
                'parameter.evidence',
                'remarks'
            ])->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data ditemukan';
            $this->responseData['targets'] = TargetResource::collection($resource);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SettingKpi  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            // cari setting kpi berdasarkan id
            $target = Target::find($id);

            // return 400 response message jika tidak ditemukan
            if (empty($target)) {
                $this->responseCode = 404;
                $this->responseMessage = 'Data tidak ditemukan';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // policy
            // if ($request->user()->cannot('delete', $target)) {
            //     $this->responseCode = 403;
    
            //     return response()->json($this->getResponse(), $this->responseCode);
            // }

            // jika yang dihapus adalah pusat atau turunan mempunyai turunan? hapus turunan
            // jika yang dihapus adalah turunan? hapus yg bersangkutan

            // pusat
            $parent = [$target->id];

            // turunan
            $children = Target::where('parent_id', $target->id)->get()->pluck('id')->toArray();

            // turunan merupakan pusat
            $subchildren = Target::whereIn('parent_id', $children)->get()->pluck('id')->toArray();

            $ids = array_values(
                array_unique(
                    array_merge($parent, $children, $subchildren),
                    SORT_NUMERIC
                )
            );

            // hapus
            Target::destroy($ids);

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah dihapus.';
            $this->responseData['target'] = $ids;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Approve
     */
    public function approve(Request $request)
    {
        try {
            if (!in_array($request->user()->role_id, [2])) {
                $roleName = $request->user()->role->name ?? 'Anda';

                $this->responseCode = 403;
                $this->responseMessage = "{$roleName} tidak dapat melakukan approval.";

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $sql = Target::query();
            $sql->whereIn('id', $request->input('id.*'));
            $sql->whereStatus(1);
            $sql->whereIn('unit_id', function ($query) {
                $query->select('id')->from('users')->whereAtasan(Auth::id());
            });
            
            $targets = $sql->get();
            
            if (empty($targets->count())) {
                $this->responseCode = 404;
                $this->responseMessage = 'Tidak ada target untuk diapprove.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $approvedTarget = $sql->update([
                'status' => 2
            ]);

            if (!empty($approvedTarget)) {
                $targetCreatedBy = $targets->pluck('created_by')->unique();

                Notification::send(
                    User::whereIn('id', $targetCreatedBy)->get(),
                    new TargetApproveNotification($targets)
                );
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disetujui.';
            $this->responseData['targets'] = TargetResource::collection($targets);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Reject
     */
    public function reject(Request $request, $id)
    {
        try {
            $target = Target::find($id);

            if (empty($target)) {
                $this->responseCode = 404;
                $this->responseMessage = 'Data tidak ditemukan.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if ($request->user()->cannot('reject', $target)) {
                $this->responseCode = 403;
    
                return response()->json($this->getResponse());
            }

            $rules = ['description' => 'required'];
            $messages = ['required' => ':attribute wajib diisi.'];
            $attributes = ['description' => 'Deskripsi'];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $target->update(['status' => 3]);
            
            TargetRemark::create([
                'target_id' => $target->id,
                'status' => $target->status,
                'description' => $request->description,
            ]);

            Notification::send(
                User::find($target->pluck('created_by')),
                new TargetRejectNotification($target)
            );

            $this->responseCode = 200;
            $this->responseMessage = 'Anda telah menolak pengajuan.';
            $this->responseData = new TargetResource($target->load([
                'year',
                'parameter',
                'unit',
                'remarks'
            ]));

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
