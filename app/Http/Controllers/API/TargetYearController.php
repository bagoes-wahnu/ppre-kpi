<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TargetYearResource;
use App\Models\TargetYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TargetYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $year = TargetYear::with([
                'parameterTargetNeedApproval' => function ($query) {
                    $query->whereIn('unit_id', function ($subquery) {
                        $subquery->select('id')->from('users')->whereAtasan(Auth::id());
                    });
                }
            ])->orderByDesc('id')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan.';
            $this->responseData['target_years'] = TargetYearResource::collection($year);

            return response()->json($this->getResponse(), $this->responseCode);
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
    public function store(Request $request)
    {
        try {
            if ($request->user()->cannot('create', TargetYear::class)) {
                $this->responseCode = 403;
    
                return response()->json($this->getResponse());
            }
            
            $rules = [
                'year' => 'required|numeric|min:1970|max:9999|unique:App\Models\TargetYear,year,NULL,id,deleted_at,NULL',
            ];

            $messages = [
                'required' => ':attribute wajib diisi',
                'numeric' => ':attribute berupa angka',
                'min' => ':attribute minimal :min',
                'max' => ':attribute maksimal :max',
                'unique' => ':attribute sudah digunakan.'
            ];

            $attributes = [
                'year' => 'Tahun'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $targetYear = new TargetYear();

            $targetYear->fill([
                'year' => $request->year,
                'is_active' => 1
            ])->save();

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan.';
            $this->responseData['target_year'] = new TargetYearResource($targetYear);

            return response()->json($this->getResponse(), $this->responseCode);
        } catch (\Exception $ex) {
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
            $targetYear = TargetYear::find($id);

            if (empty($targetYear)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Data tidak ditemukan.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan.';
            $this->responseData['target_year'] = new TargetYearResource($targetYear);

            return response()->json($this->getResponse(), $this->responseCode);

        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $targetYear = TargetYear::find($id);

            if (empty($targetYear)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Data tidak tersedia.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if ($request->user()->cannot('update', $targetYear)) {
                $this->responseCode = 403;
    
                return response()->json($this->getResponse());
            }
            
            $rules = [
                'year' => "sometimes|required|numeric|min:1970|max:9999|unique:App\Models\TargetYear,year,{$id},id,deleted_at,NULL",
                'is_active' => 'sometimes|required|boolean',
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'numeric' => ':attribute berupa angka.',
                'min' => ':attribute minimal :min.',
                'max' => ':attribute maksimal :max.',
                'unique' => ':attribute sudah digunakan.'
            ];

            $attributes = [
                'year' => 'Tahun',
                'status' => 'Status'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Form tidak valid.';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if (!$request->hasAny(['year', 'is_active'])) {
                $this->responseCode = 400;
                $this->responseMessage = 'Tidak ada request terkirim.';
    
                return response()->json($this->getResponse(), $this->responseCode);
            }

            if ($request->filled('year')) {
                $targetYear->year = $request->year;
            }

            if ($request->filled('is_active')) {
                $targetYear->is_active = $request->is_active;
            }

            $targetYear->update();

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah diperbarui.';
            $this->responseData['target_year'] = new TargetYearResource($targetYear);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $targetYear = TargetYear::find($id);

            if (empty($targetYear)) {
                $this->responseCode = 400;
                $this->responseMessage = 'Data tidak ditemukan.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if ($request->user()->cannot('delete', $targetYear)) {
                $this->responseCode = 403;
    
                return response()->json($this->getResponse());
            }

            $targetYear->delete();

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah dihapus.';
            $this->responseData['target_year'] = new TargetYearResource($targetYear);

            return response()->json($this->getResponse(), $this->responseCode);

        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
