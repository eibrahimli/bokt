<?php

namespace App\Nova\Metrics;

use App\Nova\Loan;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class LoanIsApproved extends Value
{
    public $name,$approved;
    public function __construct($component = null,$name=null,$approved = true)
    {
        parent::__construct($component);
        $this->name = $name;
        $this->approved = $approved;
    }

    public function calculate(NovaRequest $request)
    {
        return $this->count($request, \App\Models\Loan::where('approved', $this->approved));
    }

    public function ranges()
    {
        return [
            'TODAY' => __('Today'),
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }


    public function uriKey()
    {
        return $this->name;
    }
}
