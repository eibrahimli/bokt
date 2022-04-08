<?php

namespace App\Providers;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Options\Trade;
use App\Models\Transaction;
use App\Nova\Dashboards\LoanDashboards;
use App\Nova\Metrics\BranchTransaction;
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
        return array_merge($this->branchCards(),[
            new SummOfTransactions(null, 'price', 'cemi-odenisler', 'Cəmi Ödənişlər'),
            new SummOfTransactions(null, 'main_price', 'esas-cemi-odenisler', 'Əsas üzrə ödənişlər'),
            new SummOfTransactions(null, 'interested_price', 'faiz-cemi-odenisler', 'Faiz üzrə ödənişlər'),
            new RescheduledLoans(),
        ]);
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

    protected function branchCards() {
        $cards = [];
        $branches = Branch::all();
        foreach ($branches as $branch):
            $cards[] = new BranchTransaction(null, $branch->name, $branch->id,$branch->name);
        endforeach;

        return $cards;

    }
}
