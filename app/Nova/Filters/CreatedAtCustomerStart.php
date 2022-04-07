<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Filters\Filter;

class CreatedAtCustomerStart extends DateFilter
{

    public $name = 'Başlanğıc';

    public function apply(Request $request, $query, $value)
    {
        $value = Carbon::parse($value);
        return $query->where('created_at', '>=', $value);
    }
}
