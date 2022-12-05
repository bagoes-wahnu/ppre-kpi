<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DashboardVerificationStatusRealizationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $role = $request->user()->role_id;

        $statuses = [
            0 => 'Draft',
            1 => 'Menunggu',
            2 => 'Disetujui',
            3 => 'Rollback',
            404 => in_array($role, [4]) ? 'Belum ada' : '-'
        ];

        $status = $statuses[404];

        if (!empty($this->status)) {
            $status = $statuses[$this->status];
        }

        return [
            'id' => $this->id ?? null,
            //'quarter' => $this->quarter ?? null,
            'status_id' => $this->status ?? null,
            'status' =>  $status
        ];
    }
}
