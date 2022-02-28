<?php

namespace App\Nova\Filters;

use DigitalCreative\RangeInputFilter\RangeDateFilter;
use DigitalCreative\RangeInputFilter\RangeInputFilter;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class RegistryDateFilter extends RangeDateFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    //public $component = 'select-filter';
    public function name()
    {
        return __('Tarix aralığı');
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
                $query = $query->where("created_at",">=",$value["from"]);

            }

            if(isset($value["to"]) and  $value["to"]>0){
                $query = $query->where("created_at","<=",$value["to"]);

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
            'fromPlaceholder' => '',
            'toPlaceholder' => '',
            'dividerLabel' => '-',
        ];
    }
}
