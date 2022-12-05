<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardMappingScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'year_id' => $this->target_year_id,
            'unit' => $this->unit->name,
            'realizations' => DashboardMappingScoreRealizationResource::collection($this->realizations)
        ];
    }
}
