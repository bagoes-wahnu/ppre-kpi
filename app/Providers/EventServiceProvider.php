<?php

namespace App\Providers;

use App\Models\Realization;
use App\Models\RealizationChangeRequest;
use App\Models\Target;
use App\Observers\RealizationChangeRequestObserver;
use App\Observers\RealizationObserver;
use App\Observers\TargetObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Target::observe(TargetObserver::class);
        RealizationChangeRequest::observe(RealizationChangeRequestObserver::class);
        Realization::observe(RealizationObserver::class);
    }
}
