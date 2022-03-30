<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;

class KreditCreatedAtDay extends DateFilter
{
    public $name = 'Start';

    public function apply(Request $request, $query, $value)
    {

//        $value = Carbon::parse($value);
//        if(!$value) {
//            return $query;
//        }
//        return $query->whereDate('created_at', $value);

        $value = Carbon::parse($value);
        return $query->where('created_at', '>=', $value);
    }
}
