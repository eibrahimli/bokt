<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class IncomeOperation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\IncomeOperation::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $group = 'Mühasibatlıq';

    public static function label(): string
    {
        return 'Mədaxil əməliyyatları'; // TODO: Change the autogenerated stub
    }

    public static function singularLabel(): string
    {
        return 'Mədaxil əməliyyatları'; // TODO: Change the autogenerated stub
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Alıcı (filial)'), 'branch', Branch::class),
            BelongsTo::make(__('Təchizatçı'), 'supplier', Supplier::class),
            BelongsTo::make(__('Müqavilə'), 'contract', Contract::class),
            BelongsTo::make(__('Hesab'), 'account', Account::class),
            Text::make(__("Ödəniş məbləği"),"price"),
            Text::make(__("ƏDV dərəcəsi"),"edv_percent"),
            Text::make(__("ƏDV məbləği"),"edv_price"),
            Text::make(__("Debet"),"debet"),
            Text::make(__("Credit"),"Credit"),
            Date::make(__("Ödəniş tarixi"),"payment_date"),
            Text::make(__("Ödəniş metodu"),"operation_method"),
            Text::make(__("Ödəniş təyinatı"),"purpose_payment"),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}