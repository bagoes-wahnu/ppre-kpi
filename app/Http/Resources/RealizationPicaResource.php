<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class RealizationPicaResource extends JsonResource
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
            'realization_id' => $this->realization_id,
            'problem_identification' => $this->problem_identification,
            'corrective_action' => $this->corrective_action,
            'pic' => $this->pic,
            'due_date' => Carbon::parse($this->due_date)->format('d F Y'),
            'evidence' => new PicaEvidenceResource($this->whenLoaded('evidence'))
        ];
    }
}
