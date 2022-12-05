<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AtasanResource extends JsonResource
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
            'id' => $this->atasan,
            // 'role_id' => new RoleResource($this->whenLoaded('role')),
            'name' => $this->name,
            'username' => $this->username,
            'status' => $this->status,
            'pic' => $this->pic,
            'unit' => $this->unit,
            'atasan' => $this->atasan,
            // 'atasan' => new UserResource($this->whenLoaded('atasan')),
            'created_at' => (!empty($this->created_at)) ? Carbon::parse($this->created_at)->format('Y-m-d H:i:s') : null,
            'updated_at' => (!empty($this->updated_at)) ? Carbon::parse($this->updated_at)->format('Y-m-d H:i:s') : null,
            'deleted_at' => (!empty($this->deleted_at)) ? Carbon::parse($this->deleted_at)->format('Y-m-d H:i:s') : null,
        ];
    }
}
