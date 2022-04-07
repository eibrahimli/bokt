<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Filters\Filter;

class CreatedAtCustomerEnd extends DateFilter
{
    public $name = 'Son';

    public function apply(Request $request, $query, $value)
    {
        $value = Carbon::parse($value);
        return $query->where('created_at', '<=', $value);
    }
}
