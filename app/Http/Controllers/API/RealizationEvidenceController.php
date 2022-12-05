<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealizationEvidenceResource;
use App\Models\RealizationEvidence;
use App\Models\Realization as Target;
use App\Models\Realization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RealizationEvidenceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $realization
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $rules = [
                'target_id' => 'required|exists:App\Models\Target,id,deleted_at,NULL',
                'quarter' => 'required|in:1,2,3,4',
                'attachment' => 'required|mimetypes:image/jpeg,image/png,application/pdf|max:10240',
                'realization' => 'numeric'
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.',
                'mimetypes' => ':attribute yand diperbolehkan berupa file .jpeg, .png dan .pdf',
                'max' => ':attribute maksimal :max.',
                'in' => ':attribute tidak valid.',
                'numeric' => ':attribute berupa angka.',
            ];

            $attributes = [
                'target_id' => 'Target',
                'quarter' => 'Kuartal',
                'attachment' => 'Lampiran',
                'realization' => 'Nilai realisasi'
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

            $path = $this->realizationEvidencePath($request->attachment->getMimeType());

            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }

            $columns = [];

            if ($request->filled('realization')) {
                $columns['realization'] = $request->realization;
            }

            $realization = Realization::with('evidence')->firstOrCreate([
                'target_id' => $request->target_id,
                'quarter' => $request->quarter
            ], $columns);

            if (!empty($realization->evidence)) {
                $this->responseCode = 422;
                $this->responseMessage = "Realisasi evidence sudah terupload.";

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $this->attachment = $request->attachment->store($path, 'public');

            $realizationEvidence = RealizationEvidence::create([
                'realization_id' => $realization->id,
                'attachment' => $this->attachment
            ]);

            DB::commit();

            $this->responseCode = 200;
            $this->responseMessage = 'Bukti realisasi berhasil disimpan.';
            $this->responseData['realization_evidence'] = new RealizationEvidenceResource($realizationEvidence);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            Storage::disk('public')->delete($this->attachment);
            DB::rollBack();

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $realizationEvidence = RealizationEvidence::find($id);
            
            if (empty($realizationEvidence)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Bukti realisasi tidak ditemukan';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Bukti realisasi ditemukan.';
            $this->responseData['realization_evidence'] = new RealizationEvidenceResource($realizationEvidence);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Realization Evidence directory.
     * 
     * @param  object $mimeType
     * @return string
     */
    private function realizationEvidencePath($mimeType) {
        $data = ['realization-evidence'];

        switch ($mimeType) {
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
