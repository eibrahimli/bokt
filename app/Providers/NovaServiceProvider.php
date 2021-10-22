<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Options\Trade;
use App\Models\Transaction;
use App\Nova\Dashboards\LoanDashboards;
use App\Nova\Metrics\FakeReceivedTransaction;
use App\Nova\Metrics\FakeTotalTransaction;
use App\Nova\Metrics\LoanIsApproved;
use App\Nova\Metrics\NewCustomer;
use Coroowicaksono\ChartJsIntegration\AreaChart;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Coroowicaksono\ChartJsIntegration\StackedChart;
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
            new NewCustomer(null, Customer::class,null,'Aktiv Müştərilər'),
            new FakeReceivedTransaction(null,Transaction::class,'Qəbul edilən ödənişlər', 76896),
            new FakeTotalTransaction(),
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
            (new LineChart())
                ->title('Tranzaksiyalar')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Oratala Satış #1',
                    'borderColor' => '#f7a35c',
                    'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
                ],[
                    'barPercentage' => 0.5,
                    'label' => 'Ortalama Satış #2',
                    'borderColor' => '#90ed7d',
                    'data' => [90, 80, 40, 22, 79, 129, 30, 40, 90, 92, 91, 80],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                    ],
                ]),
            (new BarChart())
                ->title('Ayda ödənilən kapital')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Average Sales',
                    'backgroundColor' => '#999',
                    'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
                ],[
                    'barPercentage' => 0.5,
                    'label' => 'Average Sales 2',
                    'backgroundColor' => '#F87900',
                    'data' => [40, 62, 79, 80, 90, 79, 90, 90, 90, 92, 91, 80],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                    ],
                ])
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
