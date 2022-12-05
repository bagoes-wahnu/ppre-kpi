<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubtargetResource extends JsonResource
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
            'parent_id' => (integer) $this->parent_id,
            'year_id' => (integer) $this->target_year_id,
            'year' => new TargetYearResource($this->whenLoaded('year')),
            'parameter_id' => (integer) $this->parameter_id,
            'parameter' => new MasterParameterResource($this->whenLoaded('parameter')),
            'unit_id' => (integer) $this->unit_id,
            'unit' => new UnitResource($this->whenLoaded('unit')),
            'pic' => (string) $this->pic,
            'target' => (float) $this->target,
            'bobot' => (float) $this->bobot,
            'status' => (string) $this->status,
            'remarks' => TargetRemarkResource::collection($this->whenLoaded('remarks')),
            'realization' => new RealizationResource($this->whenLoaded('realization'), [
                'bobot' => (float) $this->bobot,
                'target' => (float) $this->target,
                'parameter_kondisi' => $this->parameter['kondisi']['value']
            ]),
        ];
    }
}
