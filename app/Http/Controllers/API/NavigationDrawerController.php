<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Target;
use App\Models\User;
use Illuminate\Http\Request;

class NavigationDrawerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->responseCode = 200;
        $this->responseData['navigation_drawer'] = [
            'setting_kpi' => $this->settingKpi()
        ];

        return response()->json($this->getResponse(), $this->responseCode);
    }
    
    private function settingKpi() {
        $target = Target::where('status', 1);
        $target->selectRaw('target_year_id, count(*) as total');
        $target->groupBy('target_year_id');

        $target->whereIn('unit_id', function ($query) {
            $query->select('id');
            $query->from((new User())->getTable());
            $query->where('atasan', auth()->user()->id);
        });
        
        $target = $target->get();

        $count = $target->count();

        return !empty($count) ? "{$count} Approval" : null;
    }
}
