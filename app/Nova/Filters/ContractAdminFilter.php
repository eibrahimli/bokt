<?php

namespace App\Nova\Filters;

use App\Nova\CustomerType;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use OptimistDigital\NovaInputFilter\InputFilter;

class ContractAdminFilter extends InputFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public function name()
    {
        return __('Admin');
    }

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($value) {
            return $query->where('user_id', $value);
        }

    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return \App\Models\User::pluck("id","name")->all();
    }
}
