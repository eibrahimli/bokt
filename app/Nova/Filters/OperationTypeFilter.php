<?php

namespace App\Nova\Filters;

use App\Nova\CustomerType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;
use Laravel\Nova\Filters\Filter;
use OptimistDigital\NovaInputFilter\InputFilter;

class OperationTypeFilter extends InputFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public function name()
    {
        return __('Əməliyyat növü');
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
            return $query->where('reg_type', $value);
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
        return [

            "Hesab Faktura"    => "INVOICE",
            "Hesab Faktura ƏDV"    => "INVOICE_EDV",
            "Mədaxil"  => "INCOME",
            "Məxaric" => "EXPENSE",
            "Məxaric ƏDV"    => "EXPENSE_EDV",
            "Kredit xidmət haqqı" => "LOAN_SERVICE ",
            "Kredit ödənişi" => "LOAN_PAYMENT ",
            "Kredit faizi ödənişi" => "LOAN_INTEREST ",
        ];
    }
}
