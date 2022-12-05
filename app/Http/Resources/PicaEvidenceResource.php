<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PicaEvidenceResource extends JsonResource
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
            'realization_pica_id' => (integer) $this->realization_pica_id,
            'initial_attachment' => asset(Storage::url($this->initial_attachment)),
            'correction_attachment' => asset(Storage::url($this->correction_attachment))
        ];
    }
}
