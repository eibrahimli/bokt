<?php

namespace App\Nova\Filters;

use DigitalCreative\RangeInputFilter\RangeInputFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class RegistryAmountFilter extends RangeInputFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    //public $component = 'select-filter';
    public function name()
    {
        return __('Məbləğ aralığı');
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
        if($value){
            if(isset($value["from"]) and $value["from"]>0){
                $query = $query->where("amount",">=",$value["from"]);

            }

            if(isset($value["to"]) and  $value["to"]>0){
                $query = $query->where("amount","<=",$value["to"]);

            }

            return  $query;

        }

        // $value will always be [ "from" => ?, "to" => ? ]
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request) : array
    {
        return [
            'fromPlaceholder' => 0,
            'toPlaceholder' => 20000,
            'dividerLabel' => '-',
        ];
    }
}
