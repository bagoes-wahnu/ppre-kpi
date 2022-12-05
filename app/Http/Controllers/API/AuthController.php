<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Validator;
use DB;
use Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ]);
    
            if($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Silahkan isi form dengan benar terlebih dahulu';
                $this->responseData['errors'] = $validator->errors();
            }
            else {
                $credentials = $request->only('username', 'password');
                $token = auth('api')->attempt($credentials);

                if (!empty($token)) {
                    $userAuth = User::where('status', 1)->with('role')->find(auth('api')->user()->id);

                    if(!empty($userAuth)) {
                        $this->responseCode = 200;
                        $this->responseMessage = 'User berhasil login';
                        $this->responseData['user'] = new UserResource($userAuth);
                        $this->responseData['token'] = $this->respondWithToken($token);
                    }
                    else {
                        $this->responseCode = 401;
                        $this->responseMessage = 'User tidak ditemukan / Tidak Aktif';
                    }
                }
                else {
                    $this->responseCode = 401;
                    $this->responseMessage = 'User tidak ditemukan / Tidak Aktif';
                }
            }
        } 
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
        }
        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function changePassword(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|confirmed'
            ]);

            if($validator->fails()) {
                $this->responseCode = 422;
                $this->responseMessage = 'Silahkan isi form dengan benar terlebih dahulu';
                $this->responseData['errors'] = $validator->errors();
                DB::rollBack();
            }
            else {
                $user = User::find(auth('api')->user()->id);

                if(!empty($user)) {
                    if(Hash::check($request->old_password, $user->password)) {
                        $user->password = Hash::make($request->new_password);
                        $user->save();
    
                        $this->responseCode = 200;
                        $this->responseMessage = 'Password berhasil diedit';
                        DB::commit();
                    }
                    else {
                        $this->responseCode = 400;
                        $this->responseMessage = 'Password lama tidak sama dengan password yang sekarang';
                        DB::rollBack();
                    }
                }
                else {
                    $this->responseCode = 400;
                    $this->responseMessage = 'User tidak ditemukan / Tidak Aktif';
                    DB::rollBack();
                }
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
        }
        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function logout(Request $request)
    {
        try {
            auth('api')->invalidate();

            $this->responseCode = 200;
            $this->responseMessage = 'User berhasil logout';
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
        }
        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function me()
    {
        try {
            $userAuth = User::with(['role'])->find(auth('api')->user()->id);
            
            if(!empty($userAuth)) {
                $this->responseCode = 200;
                $this->responseMessage = 'User berhasil ditampilkan';
                $this->responseData['user'] = new UserResource($userAuth);
            }
            else {
                $this->responseCode = 400;
                $this->responseMessage = 'User tidak ditemukan';
            }
        }
        catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();
        }
        return response()->json($this->getResponse(), $this->responseCode);
    }

    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }

    public function check_token(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){

                $this->responseCode = 200;
                $this->responseMessage = 'Token is Invalid';
                $this->responseData['user'] = false;
                return response()->json($this->getResponse(), $this->responseCode);

            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){

                $this->responseCode = 200;
                $this->responseMessage = 'Token is Expired';
                $this->responseData['user'] = false;
                return response()->json($this->getResponse(), $this->responseCode);

            }else{

                $this->responseCode = 200;
                $this->responseMessage = 'Authorization Token not found';
                $this->responseData['user'] = false;
                return response()->json($this->getResponse(), $this->responseCode);
            }
        }

        $this->responseCode = 200;
        $this->responseMessage = 'Token is Active';
        $this->responseData['user'] = $user;
        return response()->json($this->getResponse(), $this->responseCode);
    }

}
