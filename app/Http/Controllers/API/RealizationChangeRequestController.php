<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealizationChangeRequestResource;
use App\Models\ChangeRequestRemark;
use App\Models\Realization;
use App\Models\RealizationChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RealizationChangeRequestController extends Controller
{
    protected $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('public');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $realization
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $realization)
    {
        try {
            $rules = [
                'attachment' => 'required|mimetypes:image/jpeg,image/png,application/pdf|max:10240'
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'mimetypes' => ':attribute yand diperbolehkan berupa file .jpeg, .png dan .pdf',
                'max' => ':attribute maksimal :max.'
            ];

            $attributes = [
                'realization_id' => 'Realisasi',
                'attachment' => 'Lampiran'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if (!$request->attachment->isValid()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Tidak dapat mengunggah lampiran.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $realization = Realization::with('pendingChangeRequest')->find($realization);

            // data realisasi tidak tersedia
            if (empty($realization)) {
                $this->responseCode = 422;
                $this->responseMessage = 'Realisasi tidak tersedia.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // tidak bisa melakukan request edit jika status bukan approved
            if (in_array($realization->status, [0,1,3])) {
                $this->responseCode = 422;
                $this->responseMessage = 'Realisasi tidak dalam status approved.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // if (!empty($realization->pendingChangeRequest)) {
            //     $this->responseCode = 422;
            //     $this->responseMessage = 'Menunggu persetujuan.';

            //     return response()->json($this->getResponse(), $this->responseCode);
            // }

            $path = $this->uploadPath($request->attachment->getMimeType());

            if (!$this->storage->exists($path)) {
                $this->storage->makeDirectory($path);
            }
            
            $this->attachment = $request->attachment->store($path, 'public');

            $changeRequest = RealizationChangeRequest::create([
                'realization_id' => $realization->id,
                'attachment' => $this->attachment
            ]);

            $this->responseCode = 200;
            $this->responseMessage = 'Permintaan perubahan telah dikirim.';
            $this->responseData['realization_change_request'] = new RealizationChangeRequestResource($changeRequest);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            if ($this->storage->exists($this->attachment)) {
                $this->storage->delete($this->attachment);
            }

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $realization
     * @param  int  $changeRequest
     * @return \Illuminate\Http\Response
     */
    public function show($realization, $changeRequest)
    {
        try {
            $changeRequest = RealizationChangeRequest::where('realization_id', $realization)->find($changeRequest);

            if (empty($changeRequest)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Permintaan perubahan realisasi ditemukan.';
            $this->responseData['realization_change_request'] = new RealizationChangeRequestResource($changeRequest);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Reject
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $realization
     * @param  int  $changeRequest
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, $realization, $changeRequest)
    {
        try {
            $rules = [
                'description' => 'required|min:3'
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'min' => ':attribute minimal :min.'
            ];

            $attributes = [
                'description' => 'Deskripsi'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $changeRequest = RealizationChangeRequest::where('realization_id', $realization)->find($changeRequest);

            if (empty($changeRequest)) {
                $this->responseCode = 422;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $changeRequest->update(['status' => 3]);

            ChangeRequestRemark::create([
                'realization_change_request_id' => $changeRequest->id,
                'status' => $changeRequest->status,
                'description' => $request->description
            ]);

            $this->responseCode = 200;
            $this->responseMessage = 'Permintaan perubahan ditolak.';
            $this->responseData['realization_change_request'] = new RealizationChangeRequestResource($changeRequest);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Approve
     *
     * @param  int  $realization
     * @param  int  $changeRequest
     * @return \Illuminate\Http\Response
     */
    public function approve($realizationId, $changeRequestId)
    {
        DB::beginTransaction();

        try {
            $changeRequest = RealizationChangeRequest::where('realization_id', $realizationId)->find($changeRequestId);

            if (empty($changeRequest)) {
                $this->responseCode = 422;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $changeRequest->update(['status' => 2]);

            Realization::find($changeRequest->realization_id)->update(['status' => 0]);

            ChangeRequestRemark::create([
                'realization_change_request_id' => $changeRequest->id,
                'status' => $changeRequest->status,
                'description' => 'Approved'
            ]);

            DB::commit();

            $this->responseCode = 200;
            $this->responseMessage = 'Permintaan perubahan disetujui.';
            $this->responseData['realization_change_request'] = new RealizationChangeRequestResource($changeRequest);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            DB::rollBack();

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Directory upload path
     * 
     * @param  object $blob
     * @return string
     */
    private function uploadPath($blob, $path = 'realization-change-requests') {
        $data = [];

        if (!is_null($path)) {
            $data[] = $path;
        }

        switch ($blob) {
            case 'image/jpeg':
                $data[] = 'images';
                break;

            case 'image/png':
                $data[] = 'images';
                break;

            case 'application/pdf':
                $data[] = 'documents';
                break;
            
            default:
                $data[] = 'others';
                break;
        }

        return implode('/', $data);
    }
}
