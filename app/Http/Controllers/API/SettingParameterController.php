<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameter;
use App\Http\Resources\ParameterResource;
use DB;
use Validator;

class SettingParameterController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $parameter = Parameter::withoutGlobalScope('isActive')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data Setting Nilai Parameter berhasil ditampilkan';
            $this->responseData['setting_nilai_parameter'] = ParameterResource::collection($parameter);

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
                'nilai' => 'required|numeric',
            ];

            $messages = [];

            $attributes = [
                'nilai' => 'Nilai',
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
                $parameter = Parameter::find($id);

                if(!empty($parameter))
                {
                    $parameter->value = $request->nilai;
                    $parameter->save();
    
                    $this->responseCode = 200;
                    $this->responseMessage = 'Data Setting Nilai Parameter berhasil diupdate';
                    $this->responseData['setting_nilai_parameter'] = new ParameterResource($parameter);
                    DB::commit();
    
                    return response()->json($this->getResponse(), $this->responseCode);
                }
                else 
                {
                    $this->responseCode = 400;
                    $this->responseMessage = 'Data Setting Nilai Parameter tidak ditemukan';
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
            $parameter = Parameter::find($id);

            if(!empty($parameter))
            {
                $this->responseCode = 200;
                $this->responseMessage = 'Data Setting Nilai Parameter berhasil ditampilkan';
                $this->responseData['setting_nilai_parameter'] = new ParameterResource($parameter);

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
