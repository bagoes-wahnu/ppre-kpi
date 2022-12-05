<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TargetRemarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        switch ($this->status) {
            case 1:
                $this->status = 'Menunggu';
                break;

            case 2:
                $this->status = 'Disetujui';
                break;

            case 3:
                $this->status = 'Ditolak';
                break;
            
            default:
                $this->status = 'Draf';
                break;
        }

        return [
            'id' => (integer) $this->id,
            'target_id' => (integer) $this->target_id,
            'description' => (string) $this->description,
            'status' => (string) $this->status,
        ];
    }
}
