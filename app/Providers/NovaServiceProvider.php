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
use App\Nova\Metrics\RescheduledLoans;
use App\Nova\Metrics\SummOfTransactions;
use Coroowicaksono\ChartJsIntegration\AreaChart;
use Coroowicaksono\ChartJsIntegration\BarChart;
use Coroowicaksono\ChartJsIntegration\LineChart;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Eibrahimli\BranchsCard\BranchsCard;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Nycode\Trialbalance\Trialbalance;
use OptionsMenu\Select\Select;
use SaintSystems\Nova\ResourceGroupMenu\ResourceGroupMenu;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function boot()
    {
        parent::boot();
    }

    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->register();
    }

    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true;
        });
    }

    protected function cards(): array
    {
        return [

            new BranchsCard(),
            new SummOfTransactions(null, 'price', 'cemi-odenisler', 'Cəmi Ödənişlər'),
            new SummOfTransactions(null, 'main_price', 'esas-cemi-odenisler', 'Əsas üzrə ödənişlər'),
            new SummOfTransactions(null, 'interested_price', 'faiz-cemi-odenisler', 'Faiz üzrə ödənişlər'),
            new RescheduledLoans(),

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

        ];
    }

    protected function dashboards(): array
    {
        return [
            new LoanDashboards(),
        ];
    }

    public function tools(): array
    {
        return [
            new ResourceGroupMenu,
            new Trialbalance(),
            new Select(),
        ];
    }

    public function register()
    {
        //
    }
}
