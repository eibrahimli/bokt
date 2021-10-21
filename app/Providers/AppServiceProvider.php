<?php

namespace App\Providers;

use App\Composers\NavigationComposer;
use App\Models\Loan;
use App\Observers\LoanObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', NavigationComposer::class);
    }
}
