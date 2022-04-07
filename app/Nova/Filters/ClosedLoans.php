<?php

namespace App\Nova\Filters;

use \Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class ClosedLoans extends BooleanFilter
{
    public $name = 'Bağlanmış';
    public function apply(Request $request, $query, $value)
    {
        if($value['closed']) {
            return $query->where('closed', '=',$value['closed']);
        }
        return $query;
    }

    public function options(Request $request)
    {
        return [
            'Bağlanmış' => 'closed',
        ];
    }
}
