<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TargetYearResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $notification = $this->parameterTargetNeedApproval->count();
        $message = "{$notification} parameter perlu approval";

        return [
            'id' => (integer) $this->id,
            'year' => (string) $this->year,
            'is_active' => (boolean) $this->is_active,
            'notification' => 0 < $notification ? $message : null
        ];
    }
}
