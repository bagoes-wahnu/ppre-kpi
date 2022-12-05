<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ParameterResource extends JsonResource
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
            'key_setting' => $this->key_setting,
            'value' => floatval($this->value),
            'status' => $this->status,
            'created_at' => (!empty($this->created_at)) ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'updated_at' => (!empty($this->updated_at)) ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : null,
        ];
    }
}
