<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class ShouldPayDateEnd extends DateFilter
{
    public $name = 'Ödəməli olduğu gün bitiş';

    public function apply(Request $request, $query, $value)
    {
        $value = Carbon::parse($value);
        return $query->whereHas('loanReports', function($q) use($value) {
            $q->where('shouldPay', '<=', $value);
        });
    }
}
