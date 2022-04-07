<?php

namespace App\Nova\Filters;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class KreditorFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->whereRelation('customer', 'kredit_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        // dd(User::where('role', 'spervisor')->pluck('id', 'name'));
        return User::where('role', 'kreditor')->pluck('id', 'name')->toArray();
    }
}
