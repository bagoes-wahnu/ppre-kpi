<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardMappingScoreResource;
use App\Http\Resources\DashboardVerificationStatusResource;
use App\Models\MappingScore;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verificationStatusIndex(Request $request)
    {
        $user = Auth::user();

        $target = Target::query();

        $target->with([
            'unit',
            'realizations' => function ($query) {
                $query->orderBy('quarter');
            }
        ]);

        $target->where('target_year_id', $request->year_id);

        switch ($user->role_id) {
            case 4:
                $target->where('unit_id', $user->id);
                break;
        }

        $target = $this->shadowRealizationQuarter($target);
        
        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil ditampilkan';
        $this->responseData = DashboardVerificationStatusResource::collection($target);
        $this->responseRequest = $request->all();

        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function realizationGraphIndex(Request $request) {
        $user = Auth::user();

        $target = Target::query();

        $target->with([
            'realizations'
        ]);

        $target->where('target_year_id', $request->year_id);

        switch ($user->role_id) {
            case 1:
            case 2:
            case 3:
                if ($request->filled('unit_ids.*')) {
                    $target->whereIn('unit_id', $request->input('unit_ids.*') ?? []);
                }
                break;
            case 4:
                $target->where('unit_id', $user->id);
                break;
        }

        $target = $this->shadowRealizationQuarter($target);

        $realization = $target;

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil ditampilkan';
        $this->responseData = $realization;

        return response()->json($this->getResponse(), $this->responseCode);
    }

    public function mappingScoreIndex(Request $request) {
        $user = Auth::user();

        $target = Target::query();

        $target->with([
            'realizations' => function ($query) {
                $query->select('realizations.*', 'setting_mapping_scores.name as mapping_score');
                $query->join('setting_mapping_scores', function ($queryJoin) {
                    $queryJoin->whereRaw('realizations.score_x_bobot between min_value and max_value');
                });
            }
            // has one between setting_mapping score
        ]);

        $target->whereTargetYearId($request->year_id);

        switch ($user->role_id) {
            case 4:
                $target->whereUnitId($user->id);
                break;
        }

        $target = $this->shadowRealizationQuarter($target);

        $this->responseCode = 200;
        $this->responseMessage = 'Data berhasil ditampilkan';
        $this->responseData = $target;
        //$this->responseData = DashboardMappingScoreResource::collection($target);

        return response()->json($this->getResponse(), $this->responseCode);
    }

    private function shadowRealizationQuarter($eloquent) {
        $quarter = 4;

        return $eloquent->get()->map(function ($item) use ($quarter) {
            $realization = $item->realizations->count();

            if ($realization <= $quarter) {
                $different = $quarter - $realization;

                for ($i=0; $i < $different; $i++) { 
                    $nextQuarter = $realization + ($i + 1);

                    $item->realizations->push([
                        'id' => null,
                        'target_id' => $item->id,
                        'quarter' => $nextQuarter,
                        'status' => null
                    ]);
                }
            }

            $item->realizations->push([
                'target_id' => $item->id,
                'quarter' => 'final',
                'status' => null
            ]);

            return $item;
        });
    }
}
