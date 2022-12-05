<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardMappingScoreRealizationResource extends JsonResource
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
            'score' => null,
            'mapping' => null,
            'color' => '#fafafa',
            'rank' => '-'
        ];
    }
}
