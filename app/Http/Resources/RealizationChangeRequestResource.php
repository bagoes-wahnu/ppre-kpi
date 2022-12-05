<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class RealizationChangeRequestResource extends JsonResource
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
            case 2:
                $this->status = 'Approved';
                break;

            case 3:
                $this->status = 'Rejected';
                break;
            
            default:
                $this->status = 'Pending';
                break;
        }

        return [
            'id' => (integer) $this->id,
            'realization_id' => (integer) $this->realization_id,
            'attachment' => asset(Storage::url($this->attachment)),
            'status' => $this->status
        ];
    }
}
