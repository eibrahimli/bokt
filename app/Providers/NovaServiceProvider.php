<?php

namespace App\Providers;

use App\Nova\Dashboards\LoanDashboards;
use App\Nova\Metrics\LoanIsApproved;
use App\Nova\Metrics\NewCustomer;
use Coroowicaksono\ChartJsIntegration\AreaChart;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use SaintSystems\Nova\ResourceGroupMenu\ResourceGroupMenu;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new LoanIsApproved(null,'Təsdiqlənmiş kreditlər',true),
            new LoanIsApproved(null,'Təsdiqlənməmiş kreditlər',false),
            new NewCustomer(),
            (new AreaChart())
                ->title('Kreditlər')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Ortalama Kredit',
                    'backgroundColor' => '#f7a35c',
                    'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                    ],
                ]),
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new LoanDashboards(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new ResourceGroupMenu
        ];
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
}
