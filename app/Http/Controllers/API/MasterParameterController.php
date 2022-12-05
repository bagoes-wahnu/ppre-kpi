<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterParameter;
use App\Models\Perspective;
use App\Models\StrategicTarget;
use App\Models\Evidence;
use App\Models\Kondisi;
use App\Models\TypeYtd;
use App\Http\Resources\MasterParameterResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MasterParameterController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $masterParameter = MasterParameter::select(
                'id',
                'parameter',
                DB::raw("(CASE WHEN sumber = 1 THEN 'KPI Korporat' WHEN sumber = 2 THEN 'Spesifik' ELSE 'RKAP' END) as sumber"),
                'satuan',
                'kondisi_id',
                'type_ytd_id',
                'status'
            )
            ->with(['kondisi:id,value', 'type_ytd:id,value']);

            return DataTables::eloquent($masterParameter)->toJson();
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function getTypeYtd(Request $request)
    {
        try
        {
            $typeYtd = TypeYtd::select('id', 'value');

            if($request->filled('search')) {
                $typeYtd = $typeYtd->where('value', 'like', "%{$request->search}%");
            }

            $typeYtd = $typeYtd->orderBy('value')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['type_ytd'] = $typeYtd;

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function getKondisi(Request $request)
    {
        try
        {
            $kondisi = Kondisi::select('id', 'value');

            if($request->filled('search')) {
                $kondisi = $kondisi->where('value', 'like', "%{$request->search}%");
            }

            $kondisi = $kondisi->orderBy('value')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['kondisi'] = $kondisi;

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function getPerspective(Request $request)
    {
        try
        {
            $perspective = Perspective::select('id', 'name');

            if($request->filled('search')) {
                $perspective = $perspective->where('name', 'like', "%{$request->search}%");
            }

            $perspective = $perspective->orderBy('name')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['perspective'] = $perspective;

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function storePerspective(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $rules = [
                'name' => 'required'
            ];

            $messages = [];

            $attributes = [
                'name' => 'Nama'
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
                $perspective = new Perspective();
                $perspective->name = $request->name;

                $perspective->save();

                $this->responseCode = 200;
                $this->responseMessage = 'Data perspektif berhasil disimpan';
                $this->responseData['perspective'] = $perspective;
                DB::commit();

                return response()->json($this->getResponse(), $this->responseCode);
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
            DB::rollback();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function storeStrategicTarget(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $rules = [
                'perspective_id' => 'required:exists:perspective',
                'name' => 'required'
            ];

            $messages = [];

            $attributes = [
                'perspective_id' => 'Perspektif',
                'name' => 'Nama'
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
                $strategicTarget = new StrategicTarget();
                $strategicTarget->perspective_id = $request->perspective_id;
                $strategicTarget->name = $request->name;

                $strategicTarget->save();

                $this->responseCode = 200;
                $this->responseMessage = 'Data perspektif berhasil disimpan';
                $this->responseData['strategicTarget'] = $strategicTarget;
                DB::commit();

                return response()->json($this->getResponse(), $this->responseCode);
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
            DB::rollback();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function getStrategicTarget(Request $request)
    {
        try
        {
            $strategicTarget = StrategicTarget::select('id', 'perspective_id', 'name')->with('perspective:id,name');

            if($request->filled('search')) {
                $strategicTarget = $strategicTarget->where('name', 'like', "%{$request->search}%");
            }
            if($request->filled('perspective_id')) {
                $strategicTarget = $strategicTarget->where('perspective_id', $request->perspective_id);
            }

            $strategicTarget = $strategicTarget->orderBy('name')->get();

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['strategic_target'] = $strategicTarget;

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function storeParameter(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $rules = [
                'perspective_id' => 'required',
                'strategic_target_id' => 'required',
                'parameter' => 'required',
                'formula' => 'required',
                'satuan' => 'required',
                'kondisi_id' => 'required',
                'type_ytd_id' => 'required',
                'sumber' => 'required|in:1,2,3',
                'keterangan' => 'nullable'
            ];

            $messages = [];

            $attributes = [
                'perspective_id' => 'Id Perspektif',
                'strategic_target_id' => 'Id sasaran strategis',
                'parameter' => 'parameter',
                'formula' => 'formula',
                'satuan' => 'satuan',
                'kondisi_id' => 'kondisi',
                'type_ytd_id' => 'Tipe YTD',
                'sumber' => 'sumber',
                'keterangan' => 'keterangan'
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
                $parameter = new MasterParameter();
                $parameter->perspective_id = $request->perspective_id;
                $parameter->strategic_target_id = $request->strategic_target_id;
                $parameter->parameter = $request->parameter;
                $parameter->formula = $request->formula;
                $parameter->satuan = $request->satuan;
                $parameter->kondisi_id = $request->kondisi_id;
                $parameter->type_ytd_id = $request->type_ytd_id;
                $parameter->sumber = $request->sumber;
                $parameter->keterangan = $request->keterangan;

                $parameter->save();

                foreach($request->evidence ?? [] as $key => $value)
                {
                    if (!empty($value['name'])) {
                        $evidence = new Evidence();
                        $evidence->parameter_id = $parameter->id;
                        $evidence->name = $value['name'];

                        $evidence->save();
                    }
                }

                $this->responseCode = 200;
                $this->responseMessage = 'Data parameter berhasil disimpan';
                $this->responseData['parameter'] = $parameter->load('evidence');
                DB::commit();

                return response()->json($this->getResponse(), $this->responseCode);
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
            $parameter = MasterParameter::with([
                'perspective',
                'strategic_target',
                'kondisi',
                'type_ytd',
                'evidence'
            ])->find($id);

            if (empty($parameter)) {
                $this->responseCode = 404;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Data parameter berhasil ditampilkan';
            $this->responseData = new MasterParameterResource($parameter);

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
                'perspective_id' => 'required',
                'strategic_target_id' => 'required',
                'parameter' => 'required',
                'formula' => 'required',
                'satuan' => 'required',
                'kondisi_id' => 'required',
                'type_ytd_id' => 'required',
                'sumber' => 'required|in:1,2,3',
                'keterangan' => 'nullable'
            ];

            $messages = [];

            $attributes = [
                'perspective_id' => 'Id Perspektif',
                'strategic_target_id' => 'Id sasaran strategis',
                'parameter' => 'parameter',
                'formula' => 'formula',
                'satuan' => 'satuan',
                'kondisi_id' => 'kondisi',
                'type_ytd_id' => 'tyoe ytd',
                'sumber' => 'sumber',
                'keterangan' => 'keterangan'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Silahkan isi form dengan benar terlebih dahulu';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            $parameter = MasterParameter::with('evidence')->find($id);

            if (empty($parameter)) {
                $this->responseCode = 404;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if (!$request->hasAny([
                'perspective_id',
                'strategic_target_id',
                'parameter',
                'formula',
                'satuan',
                'kondisi_id',
                'type_ytd_id',
                'sumber',
                'keterangan'
            ])) {
                $this->responseCode = 400;
                $this->responseMessage = 'Tidak ada request yang terkirim.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if ($request->filled('perspective_id')) {
                $parameter->perspective_id = $request->perspective_id;
            }

            if ($request->filled('strategic_target_id')) {
                $parameter->strategic_target_id = $request->strategic_target_id;
            }

            if ($request->filled('parameter')) {
                $parameter->parameter = $request->parameter;
            }

            if ($request->filled('formula')) {
                $parameter->formula = $request->formula;
            }

            if ($request->filled('satuan')) {
                $parameter->satuan = $request->satuan;
            }

            if ($request->filled('kondisi_id')) {
                $parameter->kondisi_id = $request->kondisi_id;
            }

            if ($request->filled('type_ytd_id')) {
                $parameter->type_ytd_id = $request->type_ytd_id;
            }

            if ($request->filled('sumber')) {
                $parameter->sumber = $request->sumber;
            }

            if ($request->filled('keterangan')) {
                $parameter->keterangan = $request->keterangan;
            }

            $parameter->update();

            if (!empty($request->evidence)) {
                Evidence::where('parameter_id', $parameter->id)->forceDelete();

                foreach($request->evidence ?? [] as $value) {
                    if (!empty($value['name'])) {
                        Evidence::create([
                            'parameter_id' => $parameter->id,
                            'name' => $value['name']
                        ]);
                    };
                }
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Data parameter berhasil diperbarui.';
            $this->responseData['parameter'] = $parameter;

            DB::commit();

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            DB::rollback();

            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function changeStatus(Request $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $parameter = MasterParameter::find($id);

            if(!empty($parameter))
            {
                $parameter->status = !$parameter->status;
                $parameter->save();

                $this->responseCode = 200;
                $this->responseMessage = 'status berhasil diubah';
                $this->responseData['status'] = $parameter->status;
                DB::commit();
    
                return response()->json($this->getResponse(), $this->responseCode);
            }
            else
            {
                $this->responseCode = 400;
                $this->responseMessage = 'parameter tidak ditemukan';
                DB::rollBack();

                return response()->json($this->getResponse(), $this->responseCode);
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
            DB::rollback();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function deleteParameter(Request $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $parameter = MasterParameter::find($id);

            if(!empty($parameter))
            {
                $parameter->delete();

                $this->responseCode = 200;
                $this->responseMessage = 'Data parameter berhasil dihapus';
                $this->responseData['id'] = $id;
                DB::commit();
                
                return response()->json($this->getResponse(), $this->responseCode);
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
            DB::rollback();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
