<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MasterParameterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $sumber = null;

        if($this->sumber == 1) {
            $sumber = 'KPI Korporat';
        }
        elseif ($this->sumber == 2) {
            $sumber = 'Spesifik';
        }
        elseif ($this->sumber == 3) {
            $sumber = 'RKAP';
        }

        return [
            'id' => $this->id,
            'perspective' => new PerspectiveResource($this->whenLoaded('perspective')),
            'strategic_target' => new StrategicTargetResource($this->whenLoaded('strategic_target')),
            'parameter' => $this->parameter,
            'formula' => $this->formula,
            'satuan' => $this->satuan,
            'status' => $this->status,
            'kondisi' => new KondisiResource($this->whenLoaded('kondisi')),
            'type_ytd' => new TypeYtdResource($this->whenLoaded('type_ytd')),
            'sumber' => $this->sumber,
            'keterangan' => $this->keterangan,
            'evidence' => EvidenceResource::collection($this->whenLoaded('evidence'))
        ];
    }
}
