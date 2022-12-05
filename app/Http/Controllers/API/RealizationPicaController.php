<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RealizationPicaResource;
use App\Models\PicaEvidence;
use App\Models\Realization;
use App\Models\RealizationPica as RealizationPICA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RealizationPicaController extends Controller
{
    // public function __construct()
    // {
    //     $this->storage = Storage::disk('public');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $realization)
    {
        // DB::beginTransaction();

        // $attachments = [];

        try {
            $rules = [
                'problem_identification' => 'required',
                'corrective_action' => 'required',
                'pic' => 'required',
                'due_date' => 'required|date_format:Y-m-d'
                // 'initial_attachment' => 'required|mimetypes:image/jpeg,image/png,application/pdf|max:10240',
                // 'correction_attachment' => 'required|mimetypes:image/jpeg,image/png,application/pdf|max:10240',
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'date_format' => ':attribute tidak valid, format 1997-01-01.'
                // 'mimetypes' => ':attribute yand diperbolehkan berupa file .jpeg, .png dan .pdf',
                // 'max' => ':attribute maksimal :max.',
            ];

            $attributes = [
                'problem_identification' => 'Identifikasi masalah',
                'corrective_action' => 'Tindakan perbaikan',
                'pic' => 'PIC',
                'due_date' => 'Batas tanggal terakhir'
                // 'initial_attachment' => 'Lampiran bukti awal',
                // 'correction_attachment' => 'Lampiran pembetulan'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // $paths = [];

            // foreach ($request->only(['initial_attachment', 'correction_attachment']) as $key => $attachment) {
            //     if (!$attachment->isValid()) {
            //         $this->responseCode = 422;
            //         $this->responseMessage = "{$attributes[$key]} tidak valid.";
    
            //         return response()->json($this->getResponse(), $this->responseCode);
            //     }

            //     $paths[$key] = $this->realizationPicaEvidencePath($attachment->getMimeType());
            // }

            $realization = Realization::with('changeRequest')->find($realization);

            if (empty($realization)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            // foreach ($paths as $key => $path) {
            //     if ($this->storage->exists($path)) {
            //         $this->storage->makeDirectory($path);
            //     }

            //     $attachments[$key] = $request->{$key}->store($path, 'public');
            // }

            $pica = RealizationPICA::create([
                'realization_id' => $realization->id,
                'problem_identification' => $request->problem_identification,
                'corrective_action' => $request->corrective_action,
                'pic' => $request->pic,
                'due_date' => $request->due_date
            ]);

            // PicaEvidence::create([
            //     'realization_pica_id' => $pica->id,
            //     'initial_attachment' => $attachments['initial_attachment'],
            //     'correction_attachment' => $attachments['correction_attachment']
            // ]);

            // DB::commit();

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan';
            $this->responseData['realization_pica'] = new RealizationPicaResource($pica);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            // foreach ($attachments as $attachment) {
            //     if ($this->storage->exists($attachment)) {
            //         $this->storage->delete($attachment);
            //     }
            // }

            // DB::rollBack();

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Models\Realization  $realization
     * @param  \Illuminate\Models\RealizationPica  $pica
     * @return \Illuminate\Http\Response
     */
    public function show($realization, $pica)
    {
        try {
            $pica = RealizationPICA::with('evidence')->where('realization_id', $realization)->find($pica);

            if (empty($pica)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Resource ditemukan.';
            $this->responseData['realization_pica'] = new RealizationPicaResource($pica);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    // private function realizationPicaEvidencePath($mimeType) {
    //     $data = ['realization-pica-evidence'];

    //     switch ($mimeType) {
    //         case 'image/jpeg':
    //             $data[] = 'images';
    //             break;

    //         case 'image/png':
    //             $data[] = 'images';
    //             break;

    //         case 'application/pdf':
    //             $data[] = 'documents';
    //             break;
            
    //         default:
    //             $data[] = 'others';
    //             break;
    //     }

    //     return implode('/', $data);
    // }
}
