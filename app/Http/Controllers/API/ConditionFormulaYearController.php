<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TargetYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConditionFormulaYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditionFormulaYear = TargetYear::orderByDesc('id')->get();

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil ditampilkan.';
        $this->responseData['condition_formula_years'] = $conditionFormulaYear;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', TargetYear::class)) {
            $this->responseCode = 403;

            return response()->json($this->getResponse());
        }
        
        $rules = [
            'year' => 'required|numeric|min:1970|max:9999|unique:App\Models\TargetYear,year,NULL,deleted_at,NULL',
        ];

        $messages = [
            'required' => ':attribute wajib diisi',
            'numeric' => ':attribute berupa angka',
            'min' => ':attribute minimal :min',
            'max' => ':attribute maksimal :max',
            'unique' => ':attribute sudah digunakan.'
        ];

        $attributes = ['year' => 'Tahun'];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->responseCode = 422;
            $this->responseMessage = 'Form tidak valid.';
            $this->responseData['errors'] = $validator->errors();

            return response()->json($this->getResponse(), $this->responseCode);
        }
        
        $conditionFormulaYear = new TargetYear();

        $conditionFormulaYear->fill([
            'year' => $request->year,
            'is_active' => 1
        ])->save();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['condition_formula_year'] = $conditionFormulaYear;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conditionFormulaYear = TargetYear::find($id);

        if (empty($conditionFormulaYear)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Data tidak ditemukan.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil ditampilkan.';
        $this->responseData['condition_formula_year'] = $conditionFormulaYear;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $conditionFormulaYear = TargetYear::find($id);

        if (empty($conditionFormulaYear)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Data tidak tersedia.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        if ($request->user()->cannot('update', $conditionFormulaYear)) {
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
            $conditionFormulaYear->year = $request->year;
        }

        if ($request->filled('is_active')) {
            $conditionFormulaYear->is_active = $request->is_active;
        }

        $conditionFormulaYear->update();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah diperbarui.';
        $this->responseData['condition_formula_year'] = $conditionFormulaYear;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $conditionFormulaYear = TargetYear::find($id);

        if (empty($conditionFormulaYear)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Data tidak ditemukan.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        if ($request->user()->cannot('delete', $conditionFormulaYear)) {
            $this->responseCode = 403;
    
            return response()->json($this->getResponse());
        }

        $conditionFormulaYear->delete();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah dihapus.';
        $this->responseData['condition_formula_year'] = $conditionFormulaYear;
        
        return response()->json($this->getResponse(), $this->responseCode);
    }
}
