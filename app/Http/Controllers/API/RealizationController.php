<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealizationCollectiveLockResource;
use App\Http\Resources\TargetResource;
use App\Models\Realization;
use App\Models\RealizationRemark;
use App\Models\Target;
use App\Models\User;
use App\Notifications\RealizationApprovalNotification;
use App\Notifications\RealizationApproveNotification;
use App\Notifications\RealizationRejectNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RealizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $target = Target::with([
                'year',
                'parameter.perspective',
                'parameter.strategic_target',
                'parameter.kondisi',
                'parameter.type_ytd',
                'parameter.evidence',
                'unit',
                'remark',
                'realization' => function($query) use ($request) {
                    $query->where('quarter', $request->quarter);
                },
                'realization.evidence',
                'realization.changeRequest',
                'realization.pica.evidence'
            ]);

            $target->where([
                'target_year_id' => $request->year_id,
                'status' => 2
            ]);

            switch ($request->user()->role_id) {
                case 1: //admin
                    $target->where('unit_id', $request->unit_id);
                    break;

                case 2: //direksi
                    $target->whereIn('unit_id', function ($query) use ($request) {
                        $query->select('id');
                        $query->from((new User())->getTable());
                        $query->where('atasan', $request->user()->id);
                    });
                    break;

                case 3: //korporat
                    $target->where(function ($query) use ($request) {
                        $query->where('unit_id', $request->user()->id);
                        $query->orWhere('created_by', $request->user()->id);
                    });
                    break;

                case 4: //unit
                    $target->where(function ($query) use ($request) {
                        $query->where('unit_id', $request->user()->id);
                        $query->orWhere('created_by', $request->user()->id);
                    });
                    break;
            }

            return DataTables::eloquent($target)->toJson();
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        try {
            $rules = [
                'quarter' => 'required|in:1,2,3,4',
                'realizations' => 'required|array',
                'realizations.*.target_id' => 'required|exists:App\Models\Target,id,deleted_at,NULL',
                'realizations.*.realization' => 'required|numeric',
            ];

            $messages = [
                'in' => ':attribute tidak valid.',
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.',
                'numeric' => ':attribute berupa angka.',
                'array' => ':attribute berupa list.',
            ];

            $attributes = [
                'realizations' => 'Realisasi',
                'quarter' => 'Kuartal',
                'realizations.*.target_id' => 'Target',
                'realizations.*.realization' => 'Nilai realisasi',
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $targets = Target::with([
                // 'parameter.perspective',
                // 'parameter.strategic_target',
                'parameter.kondisi.conditionFormulas',
                // 'parameter.type_ytd',
                // 'parameter.evidence',
                'realization' => function ($query) use ($request) {
                    $query->where('quarter', $request->quarter);
                },
                'realization.evidence',
                'realization.pendingChangeRequest',
                'realization.appprovedChangeRequest',
                'realization.pica.evidence',
                // 'conditionFormula'
            ]);

            $targets->where('target_year_id', $request->year_id);

            // where condition for user role 1,2,3,4
            // ...

            $targets = $targets->get();

            $realizations = collect();

            foreach ($request->realizations as $realization) {
                $checkColumns = [
                    'target_id' => $realization['target_id'],
                    'quarter' => $request->quarter
                ];

                $fillColumns = [
                    'realization' => $realization['realization'],
                    'status' => 0
                ];

                $filter = $targets->filter(function ($item) use ($realization) {
                    return $item->id == $realization['target_id'];
                });

                $condition = $filter->pluck('parameter.kondisi.value')->first();
                $conditionFormulas = $filter->pluck('parameter.kondisi.conditionFormulas')->first();

                /**
                 * coded
                 * start
                 */
                $target = floatval($filter->pluck('target')->first());
                $bobot = floatval($filter->pluck('bobot')->first());
                $real = floatval($realization['realization']);
                
                $ach = ($real / $target) * 100;

                $scores = collect();

                foreach ($conditionFormulas as $formula) {
                    $startValue = floatval($formula->start_value);
                    $endValue = floatval($formula->end_value);
                    $score = floatval($formula->score);

                    switch ($formula->operator) {
                        case '<':
                            $xxx = $ach < $startValue ? $score : 0;
                            break;

                        case '>':
                            $xxx = $ach > $startValue ? $score : 0;
                            break;
                        
                        case '<=':
                        case '=>':
                            $xxx = in_array($ach, range($startValue, $endValue, 0.1)) ? $score : 0;
                            break;
                            
                        default:
                            $xxx = 0;
                            break;
                    }

                    $scores->push($xxx);
                }

                $score = $scores->sum();

                /**
                 * coded
                 * end
                 */

                $fillColumns['score'] = $score;
                $fillColumns['score_x_bobot'] = $score * $bobot;

                $columns = array_merge($checkColumns, $fillColumns);

                $find = Realization::with('evidence')->where($checkColumns)->first();

                if (!empty($find)) {
                    // mencegah update jika status dalam pending, approve
                    if (!in_array($find->status, [1,2])) {
                        $find->update($columns);
                    }
                } else {
                    $find = Realization::create($columns);
                }

                $realizations->push($find->id);
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan.';
            $this->responseData['realizations'] = $realizations;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function lock(Request $request) {
        if (!in_array($request->user()->role_id, [4])) {
            $this->responseCode = 403;
            $this->responseMessage = 'Hanya untuk unit.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        try {
            $rules = [
                'year_id' => 'required|exists:App\Models\TargetYear,id,deleted_at,NULL',
                'quarter' => 'required|in:1,2,3,4',
            ];

            $messages = [
                'in' => ':attribute tidak valid.',
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.'
            ];

            $attributes = [
                'year_id' => 'Tahun',
                'quarter' => 'Kuartal'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $targets = Target::with([
                'realization' => function ($query) use ($request) {
                    $query->where('quarter', $request->quarter);
                },
                'realization.evidence',
                // 'realization.pendingChangeRequest',
                // 'realization.appprovedChangeRequest',
                // 'realization.pica.evidence',
            ]);
            
            $targets->where('target_year_id', $request->year_id);

            // where condition for user role 1,2,3,4
            $targets->where(function ($query) {
                $userId = request()->user()->id;

                $query->where('unit_id', $userId);
                $query->orWhere('created_by', $userId);
            });

            $targets = $targets->get();

            // target realisasi berdasarkan quartal
            $realizations = $targets->pluck('realization');

            // list realisasi yg blm evidence
            $unevidenced = $realizations->whereNull('evidence');

            if (0 < $unevidenced->count()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Terdapat evidence yang belum terupload.';
                $this->responseData['realizations'] = RealizationCollectiveLockResource::collection($unevidenced);

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // daftar id realisasi change request
            // ...

            // daftar id realisasi pica evidence
            // ...

            // daftar id realisasi yg akan dikunci
            $ids = $realizations->pluck('id')->toArray();

            $lock = Realization::whereIn('id', $ids)->where('status', 0)->update([
                'status' => 1
            ]);

            // if ($lock > 0) {
            //     Notification::send(
            //         User::whereIn('id', $realizations->pluck('created_by')->unique())->get(),
            //         new RealizationApprovalNotification()
            //     );
            // }

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah dikunci.';
            $this->responseData['lock'] = $lock;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function collectiveLock(Request $request) {
        if (!in_array($request->user()->role_id, [3])) {
            $this->responseCode = 403;
            $this->responseMessage = 'Hanya untuk korporat (test).';

            return response()->json($this->getResponse(), $this->responseCode);
        }
        
        try {
            $rules = [
                'year_id' => 'required|exists:App\Models\TargetYear,id,deleted_at,NULL',
                'quarter' => 'required|in:1,2,3,4',
                'ids' => 'required|array',
                'ids.*' => 'required|exists:App\Models\Realization,id,deleted_at,NULL'
            ];

            $messages = [
                'in' => ':attribute tidak valid.',
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.',
                'array' => ':attribute berupa array'
            ];

            $attributes = [
                'year_id' => 'Tahun',
                'quarter' => 'Kuartal',
                'ids' => 'Realisasi',
                'ids.*' => 'Realisasi'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // get realisasi by target
            $targets = Target::with([
                'realization' => function ($query) use ($request) {
                    $query->where('quarter', $request->quarter);
                },
                'realization.evidence',
                // 'realization.pendingChangeRequest',
                // 'realization.appprovedChangeRequest',
                // 'realization.pica.evidence',
            ]);

            $targets->where('target_year_id', $request->year_id);

            // where condition for user role 1,2,3,4
            $targets->where(function ($query) {
                $userId = request()->user()->id;

                $query->where('unit_id', $userId);
                $query->orWhere('created_by', $userId);
            });

            $targets = $targets->get();
            
            $realizations = $targets->pluck('realization');
            
            $unevidenced = $realizations->whereNull('evidence')->whereIn('id', $request->input('ids.*'));

            if (0 < $unevidenced->count()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Terdapat evidence yang belum terupload.';
                $this->responseData['realizations'] = RealizationCollectiveLockResource::collection($unevidenced);

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // daftar id realisasi change request
            // ...

            // daftar id realisasi pica evidence
            // ...

            // daftar id realisasi yg akan dikunci
            $ids = $realizations->whereIn('id', $request->input('ids.*'))->pluck('id')->toArray();

            $collective_lock = Realization::whereIn('id', $ids)->where('status', 0)->update([
                'status' => 1
            ]);

            // if ($collective_lock > 0) {
            //     Notification::send(
            //         User::whereIn('id', $realizations->pluck('created_by')->unique())->get(),
            //         new RealizationApprovalNotification()
            //     );
            // }

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah dikunci.';
            $this->responseData['collective_lock'] = $collective_lock;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Approve (multiple)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        try {
            // get realisasi by target
            $targets = Target::with([
                'realization' => function ($query) use ($request) {
                    $query->where('quarter', $request->quarter);
                },
                'realization.evidence',
                'realization.pendingChangeRequest',
                'realization.appprovedChangeRequest',
                'realization.pica.evidence',
            ]);

            $targets->where('target_year_id', $request->year_id);

            // where condition for user role 1,2,3,4
            // ...

            $targets = $targets->get();

            $rules = [
                'year_id' => 'required|exists:App\Models\TargetYear,id,deleted_at,NULL',
                'quarter' => 'required|in:1,2,3,4',
                'ids' => 'required|array',
                'ids.*' => 'required|exists:App\Models\Realization,id,deleted_at,NULL'
            ];

            $messages = [
                'in' => ':attribute tidak valid.',
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.'
            ];

            $attributes = [
                'year_id' => 'Tahun',
                'ids' => 'Realisasi',
                'ids.*' => 'Realisasi'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // target realisasi berdasarkan quartal
            $realizations = $targets->pluck('realization');

            // $realizations->filter(function ($realization) use ($request) {
            //     if ($request->user()->cannot('approve', $realization)) {
            //         $this->responseCode = 403;

            //         return response()->json($this->getResponse(), $this->responseCode);
            //     }
            // });

            // ambil data collect id dari query dengn id yang akan di approve
            // jika id request tidak termasuk di data collect, skip id
            $realization_ids = $realizations->whereIn('id', $request->input('ids.*'));

            $ids = $realization_ids->pluck('id')->toArray();

            $approve = Realization::whereIn('id', $ids)->where('status', 1)->update([
                'status' => 2
            ]);

            // if (!empty($approve)) {
            //     Notification::send(
            //         User::whereIn('id', [1])->get(),
            //         new RealizationApproveNotification()
            //     );
            // }

            $this->responseCode = 200;
            $this->responseMessage = 'Nilai realisasi telah disetujui.';
            $this->responseData['approve'] = $approve;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Reject (single)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $id)
    {
        try {
            $realization = Realization::with('target')->find($id);

            if (!$realization) {
                $this->responseCode = 404;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // if ($request->user()->cannot('reject', $realization)) {
            //     $this->responseCode = 403;

            //     return response()->json($this->getResponse(), $this->responseCode);
            // }

            $rules = ['description' => 'required|min:3'];

            $messages = [
                'min' => ':attribute minimal :min karakter.',
                'required' => ':attribute wajib diisi.'
            ];

            $attributes = ['description' => 'Deskripsi'];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $reject = Realization::where([
                'id' => $realization->id,
                'status' => 1
            ])->update([
                'status' => 3
            ]);

            if (!empty($reject)) {
                RealizationRemark::create([
                    'realization_id' => $realization->id,
                    'status' => $realization->status,
                    'description' => $request->description
                ]);
    
                Notification::send(
                    User::find($realization->pluck('created_by')),
                    new RealizationRejectNotification()
                );
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Nilai realisasi tidak disetujui';
            $this->responseData['reject'] = $reject;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function performanceValueIndex() {
        $performanceValues = [];

        for ($i=0; $i < 4; $i++) {
            $triwulan = $i + 1;

            $performanceValues[] = [
                'text' => "Realisasi Kinerja TW {$triwulan}",
                'value' => floatval(23.2)
            ];
        }

        $this->responseCode = 200;
        $this->responseData['performance_values'] = $performanceValues;

        return response()->json($this->getResponse(), $this->responseCode);
    }
}
