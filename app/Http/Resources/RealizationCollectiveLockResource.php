<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealizationCollectiveLockResource extends JsonResource
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
            'realization' => $this->realization,
            'status' => $this->status,
            'target_id' => $this->target_id,
            'evidence' => $this->evidence
        ];
    }
}
