<?php

namespace App\Nova\Metrics;

use App\Models\Customer;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class ModelPerDay extends Trend
{
    protected $model;
    public $name;
    public function __construct($component = null, $model = null,$name = null)
    {
        $this->model = $model;
        $this->name = $name;
        parent::__construct($component);
    }

    public function calculate(NovaRequest $request)
    {
        return $this->countByMonths($request, Customer::class,'created_at');
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
            90 => __('90 Days'),
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
        return 'model-per-day';
    }

    public function name()
    {
        return $this->name;
    }
}
