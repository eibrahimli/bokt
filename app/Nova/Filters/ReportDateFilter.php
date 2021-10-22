<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Filters\Filter;

class ReportDateFilter extends DateFilter
{
    protected $dateField;
    protected $isFrom;
    protected $title;

    /**
     * Creates new filter instance
     *
     * @param ?string $dateField date column
     * @param boolean $isFrom   if is from
     * @param ?string $title    title of filter
     */
    public function __construct(?string $dateField, bool $isFrom, ?string $title = null)
    {

        $this->dateField = $dateField;
        $this->isFrom = $isFrom;
        if ($title) {
            $this->title = $title;
        } else {
            $this->title = $isFrom ? 'From' : 'To';
        }
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->title;
    }

    public function key()
    {
        return parent::key().'-'.$this->isFrom;
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

        $value = Carbon::parse($value);

//
//        if ($this->dateField && $value) {
//            $date = $value->format('Y-m-d');
//            $query->where($this->dateField, $this->isFrom ? '>=' : '<=', $date);
//        }

        return $query;
    }
}
