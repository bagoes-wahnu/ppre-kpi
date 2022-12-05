<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
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
            'id' => (integer) $this->id,
            'role_id' => (integer) $this->role_id,
            'name' => (string) $this->name,
            'username' => (string) $this->username,
            'status' => (integer) $this->status,
            'pic' => (string) $this->pic,
            'unit' => (string) $this->unit,
            'atasan_id' => (integer) $this->atasan
        ];
    }
}
