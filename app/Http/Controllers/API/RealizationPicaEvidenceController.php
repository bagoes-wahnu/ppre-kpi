<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PicaEvidence;
use App\Models\RealizationPica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RealizationPicaEvidenceController extends Controller
{
    public function __construct()
    {
        $this->storage = Storage::disk('public');
    }

    public function initialStore(Request $request, $realizationId, $picaId)
    {
        $attachment = null;

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
                'attachment' => 'Lampiran bukti awal'
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
                $this->responseMessage = "{$attributes['attachment']} tidak valid.";

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $pica = RealizationPica::where([
                'realization_id' => $realizationId,
                'id' => $picaId
            ])->first();

            if (empty($pica)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $path = $this->realizationPicaEvidencePath($request->attachment->getMimeType());

            if ($this->storage->exists($path)) {
                $this->storage->makeDirectory($path);
            }

            $attachment = $request->attachment->store($path, 'public');

            $evidence = PicaEvidence::updateOrCreate([
                'realization_pica_id' => $pica->id
            ], [
                'initial_attachment' => $attachment
            ]);

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan';
            $this->responseData['pica_evidence'] = $evidence;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            if (!empty($attachment)) {
                if ($this->storage->exists($attachment)) {
                    $this->storage->delete($attachment);
                }
            }

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function correctionStore(Request $request, $realizationId, $picaId)
    {
        $attachment = null;

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
                'attachment' => 'Lampiran pembetulan'
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
                $this->responseMessage = "{$attributes['attachment']} tidak valid.";

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $path = $this->realizationPicaEvidencePath($request->attachment->getMimeType());

            $pica = RealizationPica::where([
                'realization_id' => $realizationId,
                'id' => $picaId
            ])->first();

            if (empty($pica)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if ($this->storage->exists($path)) {
                $this->storage->makeDirectory($path);
            }

            $attachment = $request->attachment->store($path, 'public');

            $evidence = PicaEvidence::updateOrCreate([
                'realization_pica_id' => $pica->id
            ], [
                'correction_attachment' => $attachment
            ]);

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan';
            $this->responseData['pica_evidence'] = $evidence;

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            if (!empty($attachment)) {
                if ($this->storage->exists($attachment)) {
                    $this->storage->delete($attachment);
                }
            }

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    private function realizationPicaEvidencePath($mimeType) {
        $data = ['realization-pica-evidence'];

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
