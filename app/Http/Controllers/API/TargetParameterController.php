<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MasterParameterResource as ParameterResource;
use App\Models\MasterParameter as Parameter;
use Illuminate\Http\Request;

class TargetParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $parameters = Parameter::query();

            $parameters->with([
                'perspective',
                'strategic_target',
                'kondisi',
                'type_ytd',
                'evidence'
            ]);

            if ($request->filled('search')) {
                $parameters->where('parameter', 'LIKE', "%{$request->search}%");
            }

            if ($request->filled('hide_ids')) {
                $parameters->whereNotIn('id', $request->input('hide_ids.*'));
            }

            $parameters = $parameters->get();

            $this->responseCode = 200;
            $this->responseMessage = $parameters->count() ? 'Data berhasil ditampilkan.' : 'Tidak ada data untuk ditampilkan.';
            $this->responseData['parameters'] = ParameterResource::collection($parameters);

            return response()->json($this->getResponse(), $this->responseCode);

        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
