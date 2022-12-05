<?php

namespace App\Providers;

use App\Models\ConditionFormula;
use App\Models\Realization;
use App\Policies\TargetYearPolicy;
use App\Models\Target;
use App\Models\TargetYear;
use App\Policies\ConditionFormulaPolicy;
use App\Policies\RealizationPolicy;
use App\Policies\TargetPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        TargetYear::class => TargetYearPolicy::class,
        Target::class => TargetPolicy::class,
        Realization::class => RealizationPolicy::class,
        ConditionFormula::class => ConditionFormulaPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
    }
}
