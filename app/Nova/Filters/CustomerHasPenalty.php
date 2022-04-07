<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class CustomerHasPenalty extends BooleanFilter
{

    public $name = 'Cəriməsi olan müştərilər';

    public function apply(Request $request, $query, $value)
    {
        if(!$value['penalty']) return $query;
        return $query->whereHas('loans', function ($q) use($value) {
            $q->whereHas('loanPenalties', function ($qq) use($value) {
               $qq->where('paid', false);
            });
        });
    }

    public function options(Request $request)
    {
        return [
            'Cəriməsi olan' => 'penalty',
        ];
    }
}
