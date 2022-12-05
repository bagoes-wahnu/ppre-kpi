<?php

namespace App\Observers;

use App\Models\TargetRemark;
use App\Models\Target;

class TargetObserver
{
    /**
     * Handle the target "created" event.
     *
     * @param  \App\Target  $target
     * @return void
     */
    public function created(Target $target)
    {
        if ($target->status == 1) {
            $this->remark($target, 'Pending approval');
        }
    }

    /**
     * Handle the target "updated" event.
     *
     * @param  \App\Target  $target
     * @return void
     */
    public function updated(Target $target)
    {
        if ($target->status == 1) {
            $this->remark($target, 'Pending approval');
        }

        if ($target->status == 2) {
            $this->remark($target, 'Approved');
        }
    }

    /**
     * Handle the target "deleted" event.
     *
     * @param  \App\Target  $target
     * @return void
     */
    public function deleted(Target $target)
    {
        //
    }

    /**
     * Handle the target "restored" event.
     *
     * @param  \App\Target  $target
     * @return void
     */
    public function restored(Target $target)
    {
        //
    }

    /**
     * Handle the target "force deleted" event.
     *
     * @param  \App\Target  $target
     * @return void
     */
    public function forceDeleted(Target $target)
    {
        //
    }

    private function remark($resource, $description) {
        TargetRemark::create([
            'target_id' => $resource->id,
            'status' => $resource->status,
            'description' => $description
        ]);
    }
}
