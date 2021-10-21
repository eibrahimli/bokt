<?php

namespace App\Nova\Metrics;

use App\Models\Customer;
use Illuminate\Support\Carbon;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class NewCustomer extends Value
{
    protected $resource = null;
    protected $userId = null;

    public function __construct($component = null, $resource = Customer::class, $userId = null, $name = null)
    {
        parent::__construct($component);
        $this->resource = $resource;
        $this->userId = $userId;
        $this->name = $name;
    }

    public function calculate(NovaRequest $request)
    {
        $model = $this->resource::$model;
        $query = $model::query();

        if ($request->range) {
            $query->where('created_at', '>', (new Carbon('-' . $request->range . ' days'))->format('Y-m-d'));
        }
        return $this->result((clone $query)->count())->allowZeroResult();
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            null => __('All time'),
            1 => 'Bu gün',
            7 => 'Bu həftə',
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
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
    public function uriKey(): string
    {
        return 'new-customer';
    }

    public function name(): string
    {
        return 'Yeni Müştərilər';
    }
}
