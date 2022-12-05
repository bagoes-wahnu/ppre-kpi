<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\KondisiResource;
use App\Models\ConditionFormula;
use App\Models\Kondisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConditionFormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->cannot('viewAny', ConditionFormula::class)) {
            $this->responseCode = 403;
            
            return response()->json($this->getResponse(), $this->responseCode);
        }

        if (!$request->filled('year_id')) {
            $this->responseCode = 422;
            $this->responseMessage = 'Harap memilih tahun terlebih dahulu.';
            
            return response()->json($this->getResponse(), $this->responseCode);
        }

        $conditions = Kondisi::with('conditionFormulas')->get();

        // dd($condition->toArray());

        // $conditionFormula = ConditionFormula::query();
        
        // $conditionFormula->with([
        //     'year:id,year',
        //     'kondisi:id,value'
        // ]);

        // $conditionFormula = $conditionFormula->get([
        //     'id',
        //     'year_id',
        //     'name',
        //     'score',
        //     'category',
        //     'operator',
        //     'description',
        //     'kondisi_id',
        //     'start_value',
        //     'end_value'
        // ]);

        // $collections = $conditionFormula->groupBy('kondisi.value');

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil ditampilkan.';
        $this->responseData['conditions'] = KondisiResource::collection($conditions);

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
        if ($request->user()->cannot('create', ConditionFormula::class)) {
            $this->responseCode = 403;
            
            return response()->json($this->getResponse(), $this->responseCode);
        }

        $rules = [
            'year_id' => 'required|exists:App\Models\TargetYear,id',
            'condition_formulas' => 'required|array',
            // 'condition_formulas.*.name' => [
            //     'required',
            //     Rule::in([
            //         'lower_is_better',
            //         'higher_is_better',
            //         'optimal',
            //         'special_case'
            //     ])
            // ],
            'condition_formulas.*.score' => 'required|numeric',
            'condition_formulas.*.category' => 'required',
            'condition_formulas.*.description' => 'required',
            'condition_formulas.*.kondisi_id' => 'required|exists:App\Models\Kondisi,id',
            'condition_formulas.*.start_value' => 'required|numeric',
            'condition_formulas.*.end_value' => 'sometimes|required|numeric',
            'condition_formulas.*.operator' => [
                'required',
                Rule::in(['<', '<=', '>', '>='])
            ],
        ];

        $messages = [
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak tersedia.',
            'in' => ':attribute tidak ada dalam daftar.',
            'numeric' => ':attribute berupa angka.',
            'string' => ':attribute berupa karakter.'
        ];

        $attributes = [
            'year_id' => 'Tahun',
            'name' => 'Nama',
            'score' => 'Skor',
            'category' => 'Kategori',
            'description' => 'Deskripsi',
            'kondisi_id' => 'Kondisi',
            'start_value' => 'Nilai 1',
            'end_value' => 'Nilai 2',
            'operator' => 'Operator',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->responseCode = 422;
            $this->responseMessage = 'Form tidak valid.';
            $this->responseData['errors'] = $validator->errors();
            
            return response()->json($this->getResponse(), $this->responseCode);
        }

        // delete unsend ids
        $this->deleteUnsendIds($request);

        // create or update
        $conditionFormula = collect();
        foreach ($request->condition_formulas as $value) {
            $conditionFormula->push(ConditionFormula::updateOrCreate([
                'id' => $value['id'] ?? null
            ], [
                'year_id' => $request->year_id,
                'name' => 'Test name',
                'kondisi_id' => $value['kondisi_id'],
                'score' => $value['score'],
                'category' => $value['category'],
                'description' => $value['description'],
                'start_value' => $value['start_value'],
                'end_value' => $value['end_value'] ?? null,
                'operator' => $value['operator']
            ]));
        }

        $this->responseCode = 200;
        $this->responseMessage = 'Setting rumus kondisi berhasil disimpan.';
        $this->responseData['condition_formulas'] = $conditionFormula;
            
        return response()->json($this->getResponse(), $this->responseCode);
    }

    private function deleteUnsendIds(Request $request) {
        $conditionFormula = ConditionFormula::query();
        $conditionFormula->where('year_id', $request->year_id);
        $conditionFormula->whereNotIn('id', collect($request->condition_formulas)->pluck('id')->toArray());
        $conditionFormula->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $conditionFormula = ConditionFormula::find($id);

        if (!$conditionFormula) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';
                
            return response()->json($this->getResponse(), $this->responseCode);
        }

        if ($request->user()->cannot('delete', $conditionFormula)) {
            $this->responseCode = 403;
            
            return response()->json($this->getResponse(), $this->responseCode);
        }

        $conditionFormula->delete();

        $this->responseCode = 200;
        $this->responseMessage = 'Setting rumus kondisi berhasil dihapus.';
        $this->responseData['condition_formulas'] = $conditionFormula;
            
        return response()->json($this->getResponse(), $this->responseCode);
    }
}
