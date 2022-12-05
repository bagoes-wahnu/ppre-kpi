<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConditionFormulaResource extends JsonResource
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
            'kondisi_id' => $this->kondisi_id,
            'score' => $this->score, 
            'category' => $this->category, 
            'description' => $this->description, 
            'operator' => $this->operator,
            'start_value' => $this->start_value, 
            'end_value' => $this->end_value
        ];
    }
}
