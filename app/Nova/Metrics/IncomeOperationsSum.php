<?php

namespace App\Nova\Metrics;

use App\Models\IncomeOperation;
use App\Models\Supplier;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class IncomeOperationsSum extends Value
{
    public function __construct($component = null, $resource = IncomeOperation::class, $name = null, $type='income')
    {
        parent::__construct($component);
        $this->resource = $resource;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->sum($request, IncomeOperation::class, 'price')->allowZeroResult();


    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'TODAY' => __('Today'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'income-payments';
    }

    public function name(): string
    {
        return $this->name ?? 'Mədaxil ödənişləri';
    }
}
