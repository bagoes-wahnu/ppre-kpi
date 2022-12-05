<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardVerificationStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $statuses = collect([
            0 => 'Draft',
            1 => 'Menunggu',
            2 => 'Disetujui',
            3 => 'Rollback'
        ]);

        $status = null;

        foreach ($statuses as $key => $value) {
            if ($this->status == $key) {
                $status = $value;
            }
        }

        return [
            'id' => $this->id,
            'year_id' => $this->target_year_id,
            'unit' => $this->unit->name,
            'status_id' => $this->status,
            'status' => $status,
            'realizations' => DashboardVerificationStatusRealizationResource::collection($this->realizations)
        ];
    }
}
