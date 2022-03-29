<?php

namespace App\Nova\Filters;

use Illuminate\Database\Schema\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class KreditPenaltyFilter extends BooleanFilter
{
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

        if($value['geciken']) {
            $query->whereHas('loanReports', function ($q) {
                return $q->where('paid', 1);
            });
        }
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Geciken' => 'geciken',
        ];
    }
}
