<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StrategicTarget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StrategicTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // gate
        // ...
        
        $strategicTarget = StrategicTarget::query();
        
        $strategicTarget->withoutGlobalScope('isActive');

        $strategicTarget->with([
            'perspective'
        ]);

        return DataTables::collection($strategicTarget->get())->toJson();
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
        // gate
        // ...

        $rules = [
            'perspective_id' => 'required|exists:App\Models\Perspective,id,deleted_at,NULL',
            'name' => 'required'
        ];

        $messages = [
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak tersedia.'
        ];

        $attributes = [
            'name' => 'Nama',
            'perspective_id' => 'Perspektif'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->responseCode = 422;
            $this->responseMessage = 'Form tidak valid.';
            $this->responseData['errors'] = $validator->errors();

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $strategicTarget = StrategicTarget::create([
            'perspective_id' => $request->perspective_id,
            'name' => $request->name
        ]);

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['strategic_target'] = $strategicTarget;

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
        $strategicTarget = StrategicTarget::query();
        
        $strategicTarget->withoutGlobalScope('isActive');
        
        $strategicTarget = $strategicTarget->find($id);

        if (empty($strategicTarget)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $this->responseCode = 200;
        $this->responseMessage = 'Resource ditemukan.';
        $this->responseData['strategic_target'] = $strategicTarget;

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
        $strategicTarget = StrategicTarget::query();
        
        $strategicTarget->withoutGlobalScope('isActive');
        
        $strategicTarget = $strategicTarget->find($id);

        // gate
        // ...

        if (!$strategicTarget) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $rules = [
            'perspective_id' => 'sometimes|required|exists:App\Models\Perspective,id,deleted_at,NULL',
            'name' => 'sometimes|required'
        ];

        $messages = [
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak tersedia.'
        ];

        $attributes = [
            'name' => 'Nama',
            'perspective_id' => 'Perspektif'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->responseCode = 422;
            $this->responseMessage = 'Form tidak valid.';
            $this->responseData['errors'] = $validator->errors();

            return response()->json($this->getResponse(), $this->responseCode);
        }

        if (!$request->hasAny(['perspective_id', 'name'])) {
            $this->responseCode = 422;
            $this->responseMessage = 'Tidak ada request yang terkirim.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        if ($request->filled('perspective_id')) {
            $strategicTarget->perspective_id = $request->perspective_id;
        }

        if ($request->filled('name')) {
            $strategicTarget->name = $request->name;
        }

        $strategicTarget = $strategicTarget->update();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['strategic_target'] = $strategicTarget;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $strategicTarget = StrategicTarget::find($id);

        if (empty($strategicTarget)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $strategicTarget->delete();

        $this->responseCode = 200;
        $this->responseMessage = 'Resource telah dihapus.';
        $this->responseData['strategic_target'] = $strategicTarget;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function switchStatus($id) {
        $strategicTarget = StrategicTarget::query();
        
        $strategicTarget->withoutGlobalScope('isActive');
        
        $strategicTarget = $strategicTarget->find($id);

        if (!$strategicTarget) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $strategicTarget->status = !$strategicTarget->status;
        
        $strategicTarget->update();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['strategic_target'] = $strategicTarget;

        return response()->json($this->getResponse(), $this->responseCode);
    }
}
