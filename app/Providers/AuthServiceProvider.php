<?php

namespace App\Providers;

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
         'App\Models\Customer' => 'App\Policies\CustomerPolicy',
         'App\Models\Loan' => 'App\Policies\LoanPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Disable all restriction to admin
        Gate::before(function ($user, $abilty) {
            return ($user->role == 'admin' || ($user->group && $user->group->priority == 0)) ? true : null;
        });

        Gate::define('is-admin', function ($user) {
            return $user->group && $user->group->priority == 0;
        });

        Gate::define('disable', function () {
            return false;
        });
    }
}
