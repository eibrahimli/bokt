<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\LoanIsApproved;
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
