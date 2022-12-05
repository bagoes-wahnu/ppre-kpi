<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\AtasanResource;
use DB;
use Validator;
use DataTables;
use Carbon\Carbon;
use Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try
        {
            $user = User::select('users.id', 'users.name', 'role_id','roles.name as tipe', 'users.status')
            ->join('roles', 'roles.id', '=', 'users.role_id');

            return DataTables::eloquent($user)->toJson();
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $rules = [
                'name' => 'required',
                'username' => 'required|unique:users',
                'type' => 'required|in:1,2',
                'password' => 'required'
            ];

            $messages = [];

            $attributes = [
                'name' => 'Nama',
                'username' => 'Username',
                'password' => 'Password'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) 
            {
                $this->responseCode = 422;
                $this->responseMessage = 'Silahkan isi form dengan benar terlebih dahulu';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            else 
            {
                if($request->type == 1) {
                    $role_id = 3;
                }
                elseif ($request->type == 2 && $request->is_atasan == 0) {
                    $role_id = 2;
                }
                elseif ($request->type == 2 && $request->is_atasan == 1 && $request->jenis == 1) {
                    $role_id = 2;
                }
                elseif ($request->type == 2 && $request->is_atasan == 1 && $request->jenis == 2) {
                    $role_id = 4;
                }

                $user = new User();
                $user->name = $request->name;
                $user->username = $request->username;
                $user->password = Hash::make($request->password);
                $user->role_id = $role_id;
                $user->pic = $request->pic;
                $user->unit = $request->unit;
                $user->atasan = $request->atasan;
                $user->jenis = $request->jenis ?? null;

                $user->save();

                $this->responseCode = 200;
                $this->responseMessage = 'Data user berhasil disimpan';
                $this->responseData['user'] = $user;
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
            $user = User::with(['role:id,name', 'atasan:id,name'])->find($id);
            $atasan = User::with(['atasan:name'])->find($id);
            // dump($atasan);
            // $atasan = User::with(['atasan:id,name'])->whereColumn('atasan', '=', 'id')->find($id);
            // $atasan = User::select('id', 'name', 'atasan')->where('atasan', '=' ,'id');

            if(!empty($user))
            {
                $this->responseCode = 200;
                $this->responseMessage = 'Data user berhasil disimpan';
                $this->responseData['user'] = $user;
                // $this->responseData['atasan'] = new AtasanResource($atasan);

                return response()->json($this->getResponse(), $this->responseCode);
            }
            else 
            {
                $this->responseCode = 400;
                $this->responseMessage = 'User tidak ditemukan';

                return response()->json($this->getResponse(), $this->responseCode);
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $user = User::find($id);

            if (!$user) {
                $this->responseCode = 404;
                $this->responseMessage = 'Server tidak dapat menemukan resource yang diminta.';

                return response()->json($this->getResponse(), $this->responseCode);
            }

            $rules = [
                'type' => 'required|in:1,2',
                'is_atasan' => 'sometimes|required|boolean',
                'jenis' => 'sometimes|required|in:1,2',
                'name' => 'sometimes|required',
                // 'username' => 'sometimes|required|unique:users',
                'pic' => 'sometimes|required',
                'atasan' => 'sometimes|required|exists:App\Models\User,id'
            ];

            $messages = [
                'required' => ':attribute wajib diisi.',
                'exists' => ':attribute tidak tersedia.',
                'in' => ':attribute yang dipilih tidak valid.'
            ];

            $attributes = [
                'name' => 'Nama',
                // 'username' => 'Username',
                'pic' => 'PIC',
                'atasan' => 'Atasan',
                'jenis' => 'Jenis'
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Silahkan isi form dengan benar terlebih dahulu';
                $this->responseData['errors'] = $validator->errors();

                return response()->json($this->getResponse(), $this->responseCode);
            }

            if (!$request->hasAny(['name', 'pic', 'atasan', 'jenis'])) {
                $this->responseCode = 422;
                $this->responseMessage = 'Tidak ada request yang dikirim.';

                return response()->json($this->getResponse(), $this->responseCode);
            }
            
            if($request->type == 1) {
                $role_id = 3;
            } elseif ($request->type == 2 && $request->is_atasan == 0) {
                $role_id = 2;
            } elseif ($request->type == 2 && $request->is_atasan == 1 && $request->jenis == 1) {
                $role_id = 2;
            } elseif ($request->type == 2 && $request->is_atasan == 1 && $request->jenis == 2) {
                $role_id = 4;
            }

            if ($request->filled('name')) {
                $user->name = $request->name;
            }

            if ($request->filled('pic')) {
                $user->pic = $request->pic;
            }

            if ($request->filled('atasan')) {
                $user->atasan = $request->atasan;
            }

            if ($request->filled('jenis')) {
                $user->jenis = $request->jenis;
            }

            $user->role_id = $role_id;
            
            $user->update();

            $this->responseCode = 200;
            $this->responseMessage = 'Data telah disimpan.';
            $this->responseData['user'] = $user;

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
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
            $user = User::find($id);

            if(!empty($user))
            {
                $user->status = !$user->status;
                $user->save();

                $this->responseCode = 200;
                $this->responseMessage = 'status berhasil diubah';
                $this->responseData['status'] = $user->status;
                DB::commit();
    
                return response()->json($this->getResponse(), $this->responseCode);
            }
            else
            {
                $this->responseCode = 400;
                $this->responseMessage = 'User tidak ditemukan';
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

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $user = User::find($id);

            if(!empty($user))
            {
                $user->delete();

                $this->responseCode = 200;
                $this->responseMessage = 'user berhasil dihapus';
                DB::commit();

                return response()->json($this->getResponse(), $this->responseCode);
            }
            else
            {
                $this->responseCode = 400;
                $this->responseMessage = 'User tidak ditemukan';
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

    public function getPimpinan(Request $request)
    {
        try
        {
            $user = User::query();
            // $user->select('id', 'name');
            $user->where('status', 1);
            $user->whereNull('atasan');
            $user->whereNotIn('role_id', [1]);

            if($request->filled('search')) {
                $user->where('name', 'like', "%{$request->search}%");
            }

            $user->orderBy('name');

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['user'] = $user->get();

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }

    public function structure() 
    {
        try
        {
            $data = [];

            $get_atasan = User::where('status', 1)->whereNull('atasan')->whereNotIn('role_id', [1])->orderBy('name')->get()->toArray();

            if (count($get_atasan) !== 0) {
                foreach ($get_atasan as $key => $value) {
                    $bawahan1 = User::select(['id', 'name', 'pic', 'atasan'])->where('status', 1)->where('atasan', $value['id'])
                        ->orderBy('name')->get()->toArray();

                    $data2 = [];
                    if (count($bawahan1) !== 0) {
                        foreach ($bawahan1 as $key => $value2) {
                            $bawahan2 = User::select(['id', 'name', 'pic', 'atasan'])->where('status', 1)->where('atasan', $value2['id'])
                                ->orderBy('name')->get()->toArray();

                            $data3 = [];
                            if (count($bawahan2) !== 0) {
                                foreach ($bawahan2 as $key => $value3) {
                                    $bawahan3 = User::select(['id', 'name', 'pic', 'atasan'])->where('status', 1)->where('atasan', $value3['id'])
                                        ->orderBy('name')->get()->toArray();

                                    $data4 = [];
                                    if (count($bawahan3) !== 0) {
                                        foreach ($bawahan3 as $key => $value4) {
                                            $bawahan4 = User::select(['id', 'name', 'pic', 'atasan'])->where('status', 1)->where('atasan', $value4['id'])
                                                ->orderBy('name')->get()->toArray();

                                            $data5 = [];
                                            if (count($bawahan4) !== 0) {
                                                foreach ($bawahan4 as $key => $value5) {
                                                    $bawahan5 = User::select(['id', 'name', 'pic', 'atasan'])->where('status', 1)->where('atasan', $value5['id'])
                                                        ->orderBy('name')->get()->toArray();

                                                    $data6 = [];
                                                    if (count($bawahan5) !== 0) {
                                                        foreach ($bawahan5 as $key => $value6) {
                                                            array_push($data6, $value6);
                                                        }
                                                        $value5['bawahan'] = $data6;
                                                        array_push($data5, $value5);
                                                    }
                                                }
                                            }
                                            $value4['bawahan'] = $data5;
                                            array_push($data4, $value4);
                                        }
                                    }
                                    $value3['bawahan'] = $data4;
                                    array_push($data3, $value3);
                                }
                            }
                            $value2['bawahan'] = $data3;
                            array_push($data2, $value2);
                        }
                    }
                    $value['bawahan'] = $data2;
                    array_push($data, $value);
                }
            }

            $this->responseCode = 200;
            $this->responseMessage = 'Data berhasil ditampilkan';
            $this->responseData['structure'] = $data;

            return response()->json($this->getResponse(), $this->responseCode);
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
