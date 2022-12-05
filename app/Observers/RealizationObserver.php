<?php

namespace App\Observers;

use App\Models\Realization;
use App\Models\RealizationRemark;

class RealizationObserver
{
    /**
     * Handle the realization "created" event.
     *
     * @param  \App\Realization  $realization
     * @return void
     */
    public function created(Realization $realization)
    {
        if ($realization->status == 1) {
            $this->remark($realization, 'Pending approval');
        }
    }

    /**
     * Handle the realization "updated" event.
     *
     * @param  \App\Realization  $realization
     * @return void
     */
    public function updated(Realization $realization)
    {
        if ($realization->status == 1) {
            $this->remark($realization, 'Pending approval');
        }

        if ($realization->status == 2) {
            $this->remark($realization, 'Approved');
        }
    }

    /**
     * Handle the realization "deleted" event.
     *
     * @param  \App\Realization  $realization
     * @return void
     */
    public function deleted(Realization $realization)
    {
        //
    }

    /**
     * Handle the realization "restored" event.
     *
     * @param  \App\Realization  $realization
     * @return void
     */
    public function restored(Realization $realization)
    {
        //
    }

    /**
     * Handle the realization "force deleted" event.
     *
     * @param  \App\Realization  $realization
     * @return void
     */
    public function forceDeleted(Realization $realization)
    {
        //
    }

    private function remark($resource, $description) {
        RealizationRemark::create([
            'realization_id' => $resource->id,
            'status' => $resource->status,
            'description' => $description
        ]);
    }
}
