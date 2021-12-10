<?php

namespace Eibrahimli\MonthlyCreditPaymentReport;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });
        Nova::serving(function (ServingNova $event) {
            Nova::script('monthly-credit-payment-report', __DIR__.'/../dist/js/field.js');
            Nova::style('monthly-credit-payment-report', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function routes() {
        if($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('eibrahimli')
            ->group(__DIR__.'/../routes/api.php');
    }
}
