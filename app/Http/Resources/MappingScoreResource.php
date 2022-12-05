<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class MappingScoreResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'min_value' => floatval($this->min_value),
            'max_value' => floatval($this->max_value),
            'status' => $this->status,
            'color' => new ColorResource($this->whenLoaded('color')),
            'created_at' => (!empty($this->created_at)) ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'updated_at' => (!empty($this->updated_at)) ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : null,
        ];
    }
}
