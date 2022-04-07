<?php

namespace App\Nova\Filters;

use App\Models\Branch;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class BranchFilter extends Filter
{
    public $name = 'Filial';

    public $component = 'select-filter';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('branch_id', $value);
    }

    public function options(Request $request)
    {
        return Branch::all()->pluck('id', 'name')->toArray();
    }
}
