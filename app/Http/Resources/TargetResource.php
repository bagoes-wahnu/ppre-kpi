<?php

namespace App\Http\Resources;

use App\Models\Realization;
use Illuminate\Http\Resources\Json\JsonResource;

class TargetResource extends JsonResource
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
                $status = 'Menunggu';
                break;

            case 2:
                $status = 'Disetujui';
                break;

            case 3:
                $status = 'Ditolak';
                break;
            
            default:
                $status = 'Draf';
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
            'status_id' => (integer) $this->status,
            'status' => (string) $status,
            // 'remarks' => TargetRemarkResource::collection($this->whenLoaded('remarks')),
            'remark' => new TargetRemarkResource($this->whenLoaded('remark')),
            'realization' => new RealizationResource($this->whenLoaded('realization')),
            // 'subtargets' => SubtargetResource::collection($this->subtargets)
        ];
    }
}
