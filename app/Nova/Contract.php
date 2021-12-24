<?php

namespace App\Nova;

use App\Nova\Filters\ContractBrachFilter;
use App\Nova\Filters\ContractNumberFilter;
use App\Nova\Filters\ContractPriceFilter;
use App\Nova\Filters\ContractSupplierFilter;
use App\Nova\Metrics\ContractsMetrics;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use NrmlCo\NovaBigFilter\NovaBigFilter;

class Contract extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Contract::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
/*    public static $title = 'contract_number';*/

    public function title()
    {
        return "№{$this->contract_number} ({$this->supplier->name}) ({$this->branch->name}) ";
    }

    public static $group = 'Mühasibatlıq';

    public static function label(): string
    {
        return 'Müqavilələr'; // TODO: Change the autogenerated stub
    }

    public static function singularLabel(): string
    {
        return 'Müqavilə'; // TODO: Change the autogenerated stub
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
            BelongsTo::make(__('Alıcı (filial)'), 'branch', Branch::class)->showCreateRelationButton(),
            BelongsTo::make(__('Təchizatçı'), 'supplier', Supplier::class)->showCreateRelationButton(),
            Text::make(__("Müqavilə Nömrəsi"),"contract_number"),
            Text::make(__("Müqavilə məbləği"),"price"),
            Text::make(__("Avans məbləği"),"advance_price"),
            BelongsTo::make(__('Valyuta'), 'currency', Currency::class)->showCreateRelationButton(),
            Date::make(__("Müqavilə tarixi"),"contract_date"),
            Date::make(__("Müqavilə başlayır"),"contract_begin"),
            Date::make(__("Müqavilə bitir"),"contract_end"),
            HasMany::make('İş və xidmətlər', 'works', \App\Nova\Work::class),
            HasMany::make('Qeyri maddi aktivlər', 'assets', \App\Nova\MainAsset::class),
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
        return [

            new ContractsMetrics(null,$this,"Yeni müqavilələr","new"),
            new ContractsMetrics(null,$this,"Toplam məbləğ","price"),
            new NovaBigFilter(),

        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ContractBrachFilter(),
            new ContractSupplierFilter(),
            new ContractNumberFilter(),
            new ContractPriceFilter()
        ];
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
