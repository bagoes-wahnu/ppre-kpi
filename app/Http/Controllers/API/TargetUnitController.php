<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TargetUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $units = Unit::query();

            // tidak menampilkan unit jika sudah digunakan pada tahun xxxx
            // $units->whereDoesntHave('target', function ($query) use ($request) {
            //     $query->where('target_year_id', $request->year_id);
            // });

            if ($request->filled('hide_id')) {
                $units->whereKeyNot($request->hide_id);
            }

            $units->where(function ($query) {
                // 1. tipenya korporat
                $query->where('role_id', 3);

                // 2. tipenya unit, yang punya atasan + jenisnya unit
                $query->orWhere(function ($query) {
                    $query->where('role_id', 4);
                    $query->whereNotNull('atasan');
                });
            });

            // filter jika melakukan pencarian
            if ($request->filled('search')) {
                $units->where('name', 'LIKE', "%{$request->search}%");
            }

            $units = $units->get();

            $this->responseCode = 200;
            $this->responseMessage = $units->count() ? 'Data berhasil ditampilkan.' : 'Tidak ada data untuk ditampilkan.';
            $this->responseData['units'] = UnitResource::collection($units);

            return response()->json($this->getResponse(), $this->responseCode);

        } catch (\Exception $ex) {
            $this->responseCode = 500;
            $this->responseMessage = $ex->getMessage();

            return response()->json($this->getResponse(), $this->responseCode);
        }
    }
}
