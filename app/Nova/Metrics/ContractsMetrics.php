<?php

namespace App\Nova\Metrics;

use App\Models\Contract;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class ContractsMetrics extends Value
{
    public function __construct($component = null, $resource = Contract::class, $name = null, $type='new')
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
        if($this->type == 'new'){
            return  $this->count($request, Contract::class);
        }elseif($this->type == 'price'){
            return $this->sum($request, Contract::class, 'price')->allowZeroResult();
        }

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
        return $this->type.'-contracts';
    }

    public function name(): string
    {
        return $this->name ?? 'Yeni Müqavilələr';
    }
}
