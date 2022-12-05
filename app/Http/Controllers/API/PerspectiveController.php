<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Perspective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PerspectiveController extends Controller
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
        
        $perspective = Perspective::query();
        
        $perspective->withoutGlobalScope('isActive');

        return DataTables::eloquent($perspective)->toJson();
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
            'name' => 'required'
        ];

        $messages = [
            'required' => ':attribute wajib diisi.'
        ];

        $attributes = [
            'name' => 'Nama'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->responseCode = 422;
            $this->responseMessage = 'Form tidak valid.';
            $this->responseData['errors'] = $validator->errors();

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $perspective = Perspective::create([
            'name' => $request->name
        ]);

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['perspective'] = $perspective;

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
        $perspective = Perspective::query();

        $perspective->withoutGlobalScope('isActive');
        
        $perspective = $perspective->find($id);

        if (empty($perspective)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $this->responseCode = 200;
        $this->responseMessage = 'Resource ditemukan.';
        $this->responseData['perspective'] = $perspective;

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
        $perspective = Perspective::query();
        
        $perspective->withoutGlobalScope('isActive');
        
        $perspective = $perspective->find($id);

        // gate
        // ...

        if (!$perspective) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $rules = [
            'name' => 'sometimes|required'
        ];

        $messages = [
            'required' => ':attribute wajib diisi.'
        ];

        $attributes = [
            'name' => 'Nama'
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->responseCode = 422;
            $this->responseMessage = 'Form tidak valid.';
            $this->responseData['errors'] = $validator->errors();

            return response()->json($this->getResponse(), $this->responseCode);
        }

        if (!$request->hasAny(['name'])) {
            $this->responseCode = 422;
            $this->responseMessage = 'Tidak ada request yang terkirim.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        if ($request->filled('name')) {
            $perspective->name = $request->name;
        }

        $perspective->update();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['perspective'] = $perspective;

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
        $perspective = Perspective::find($id);

        if (empty($perspective)) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $perspective->delete();

        $this->responseCode = 200;
        $this->responseMessage = 'Resource telah dihapus.';
        $this->responseData['perspective'] = $perspective;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function switchStatus($id) {
        $perspective = Perspective::query();
        
        $perspective->withoutGlobalScope('isActive');
        
        $perspective = $perspective->find($id);

        if (!$perspective) {
            $this->responseCode = 404;
            $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

            return response()->json($this->getResponse(), $this->responseCode);
        }

        $perspective->status = !$perspective->status;
        
        $perspective->update();

        $this->responseCode = 200;
        $this->responseMessage = 'Data telah disimpan.';
        $this->responseData['perspective'] = $perspective;

        return response()->json($this->getResponse(), $this->responseCode);
    }
}
