<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MappingScore;
use App\Models\Color;
use App\Http\Resources\MappingScoreResource;
use App\Http\Resources\ColorResource;
use DB;
use Validator;

class SettingMappingScoreController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $mapping_score = MappingScore::withoutGlobalScope('isActive')->with('color')->orderBy('id')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data Setting Mapping Score berhasil ditampilkan';
            $this->responseData['setting_mapping_score'] = MappingScoreResource::collection($mapping_score);

            return response()->json($this->getResponse(), $this->responseCode);

        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $rules = [
            	'nama' => 'required',
            	'keterangan' => 'required',
                'nilai_minimal' => 'required|numeric',
                'nilai_maksimal' => 'required|numeric|gt:nilai_minimal',
            ];

            $messages = [];

            $attributes = [
                'nama' => 'Nama Mapping',
                'keterangan' => 'Keterangan Mapping',
                'nilai_minimal' => 'Nilai Minimal',
                'nilai_maksimal' => 'Nilai Maksimal',
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails())
            {
                $this->responseCode = 422;
                $this->responseMessage = 'Silahkan isi form dengan benar terlebih dahulu';
                $this->responseData['errors'] = $validator->errors();
                DB::rollBack();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            else 
            {
                $mapping_score = MappingScore::find($id);

                if(!empty($mapping_score))
                {
                	if (!empty($request->id_warna)) {

                		$color = Color::withoutGlobalScope('isActive')->find($request->id_warna);

                		if (empty($color)) {

                			$this->responseCode = 400;
		                    $this->responseMessage = 'Data Warna tidak ditemukan';
		                    DB::rollBack();
		                    return response()->json($this->getResponse(), $this->responseCode);
                		}

                		$warna_digunakan = MappingScore::withoutGlobalScope('isActive')->where('id', '<>', $id)->where('color_id', $request->id_warna)->first();

                		if (!empty($warna_digunakan)) {
                			
                			$this->responseCode = 400;
		                    $this->responseMessage = 'Warna yang dipilih telah digunakan untuk data lain';
		                    DB::rollBack();
		                    return response()->json($this->getResponse(), $this->responseCode);
                		}
                	}

                	$mapping_score->color_id = $request->id_warna;
                    $mapping_score->name = $request->nama;
                    $mapping_score->description = $request->keterangan;
                    $mapping_score->min_value = $request->nilai_minimal;
                    $mapping_score->max_value = $request->nilai_maksimal;
                    $mapping_score->save();
    
                    $this->responseCode = 200;
                    $this->responseMessage = 'Data Setting Mapping Score berhasil diupdate';
                    $this->responseData['setting_mapping_score'] = new MappingScoreResource(MappingScore::with('color')->find($id));
                    DB::commit();
    
                    return response()->json($this->getResponse(), $this->responseCode);
                }
                else 
                {
                    $this->responseCode = 400;
                    $this->responseMessage = 'Data Setting Mapping Score tidak ditemukan';
                    DB::rollBack();

                    return response()->json($this->getResponse(), $this->responseCode);
                }
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
            DB::rollback();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

     public function show(Request $request, $id)
    {
        try
        {
            $mapping_score = MappingScore::with('color')->find($id);
            $color = color::withoutGlobalScope('isActive')->get();

            if(!empty($mapping_score))
            {
                $this->responseCode = 200;
                $this->responseMessage = 'Data Setting Nilai Parameter berhasil ditampilkan';
                $this->responseData['setting_nilai_parameter'] = new MappingScoreResource($mapping_score);
				$this->responseData['color_list'] = ColorResource::collection($color);

                return response()->json($this->getResponse(), $this->responseCode);
            }
            else 
            {
                $this->responseCode = 400;
                $this->responseMessage = 'Data Setting Nilai Parameter tidak ditemukan';

                return response()->json($this->getResponse(), $this->responseCode);
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
