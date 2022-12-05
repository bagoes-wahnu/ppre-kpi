<?php

namespace App\Observers;

use App\Models\ChangeRequestRemark;
use App\Models\RealizationChangeRequest;
use App\Models\User;
use App\Notifications\RealizationChangeRequestApprovalNotification;
use App\Notifications\RealizationChangeRequestApproveNotification;
use App\Notifications\RealizationChangeRequestRejectNotification;
use Illuminate\Support\Facades\Notification;

class RealizationChangeRequestObserver
{
    /**
     * Handle the realization change request "created" event.
     *
     * @param  \App\RealizationChangeRequest  $realizationChangeRequest
     * @return void
     */
    public function created(RealizationChangeRequest $realizationChangeRequest)
    {
        ChangeRequestRemark::create([
            'realization_change_request_id' => $realizationChangeRequest->id,
            'status' => $realizationChangeRequest->status,
            'description' => 'Pending approval'
        ]);

        Notification::send(
            User::find(auth()->user()->atasan ?? 1),
            new RealizationChangeRequestApprovalNotification()
        );
    }

    /**
     * Handle the realization change request "updated" event.
     *
     * @param  \App\RealizationChangeRequest  $realizationChangeRequest
     * @return void
     */
    public function updated(RealizationChangeRequest $realizationChangeRequest)
    {
        if ($realizationChangeRequest->status == 2) {
            ChangeRequestRemark::create([
                'realization_change_request_id' => $realizationChangeRequest->id,
                'status' => $realizationChangeRequest->status,
                'description' => 'Approved'
            ]);

            Notification::send(
                User::find($realizationChangeRequest->pluck('created_by')),
                new RealizationChangeRequestApproveNotification()
            );
        }

        if ($realizationChangeRequest->status == 3) {
            Notification::send(
                User::find($realizationChangeRequest->pluck('created_by')),
                new RealizationChangeRequestRejectNotification()
            );
        }
    }

    /**
     * Handle the realization change request "deleted" event.
     *
     * @param  \App\RealizationChangeRequest  $realizationChangeRequest
     * @return void
     */
    public function deleted(RealizationChangeRequest $realizationChangeRequest)
    {
        //
    }

    /**
     * Handle the realization change request "restored" event.
     *
     * @param  \App\RealizationChangeRequest  $realizationChangeRequest
     * @return void
     */
    public function restored(RealizationChangeRequest $realizationChangeRequest)
    {
        //
    }

    /**
     * Handle the realization change request "force deleted" event.
     *
     * @param  \App\RealizationChangeRequest  $realizationChangeRequest
     * @return void
     */
    public function forceDeleted(RealizationChangeRequest $realizationChangeRequest)
    {
        //
    }
}
