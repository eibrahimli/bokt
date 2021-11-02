<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\LoanIsApproved;
use Eibrahimli\BranchsCard\BranchsCard;
use Laravel\Nova\Dashboard;

class LoanDashboards extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new BranchsCard(),
            new LoanIsApproved()
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'loan-cards';
    }
}
