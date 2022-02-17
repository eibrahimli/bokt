<?php

namespace App\Nova;

use App\Nova\Filters\ContractBrachFilter;
use App\Nova\Filters\ContractFilter;
use App\Nova\Filters\ContractSupplierFilter;
use App\Nova\Metrics\AssetsMetrics;
use App\Nova\Metrics\ContractsMetrics;
use Eibrahimli\EdvCalculation\EdvCalculation;
use Eibrahimli\EdvTool\EdvTool;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Http\Request;
use KossShtukert\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Yassi\NestedForm\NestedForm;

class MainAsset extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\MainAsset::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $group = 'Mühasibatlıq';

    public static function label(): string
    {
        return 'Əsas vəsaitlər və Qeyri Maddi Aktivlər '; // TODO: Change the autogenerated stub
    }

    public static function singularLabel(): string
    {
        return 'Əsas vəsaitlər və Qeyri Maddi Aktivlər'; // TODO: Change the autogenerated stub
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

           DynamicSelect::make('Təchizatçı', 'supplier_id')
                ->options(\App\Models\Supplier::pluck("name","id")->all()),
                //->rules('required'),

           DynamicSelect::make('Filial', 'branch_id')
                ->options(\App\Models\Branch::pluck("name","id")->all()),
                //->rules('required'),

           DynamicSelect::make('Müqavilə', 'contract_id')
               ->dependsOn(['supplier_id', 'branch_id'])
               ->options(function($values) {
                   $contracts = \App\Models\Contract::whereNull("deleted_at");
                    if(isset($values["supplier_id"])){
                        $contracts = $contracts->where("supplier_id",$values["supplier_id"]);
                    }

                    if(isset($values["branch_id"])){
                        $contracts = $contracts->where("branch_id",$values["branch_id"]);
                    }

                   $contracts =  $contracts->pluck("contract_number","id");
                    return $contracts;

               }),
               //->rules('required')

            BelongsTo::make(__('Müqavilə'), 'contract', Contract::class)->onlyOnIndex(),
            Text::make(__("Hesab Faktura Nömrəsi"),"invoice_number"),
            Text::make(__("EQF Nömrəsi"),"einvoice_number"),
            Date::make(__("EQF Tarixi"),"einvoice_date"),
            BelongsTo::make(__('Amortizasiya hesabı'), 'depAccount', DepreciationAccount::class)->showCreateRelationButton(),
/*            BelongsTo::make(__('Branch'), 'branch', Branch::class)->showCreateRelationButton(),*/
            Text::make(__("Əsas vəsaitin saxlandığı yer"),"asset_location"),
            BelongsTo::make(__('Məsul şəxs'), 'user', User::class)->showCreateRelationButton(),
            NestedForm::make('AssetInner')->heading('Malların siyahısı'),
            HasMany::make(__('Malların siyahısı'), 'AssetInner', AssetInner::class)->onlyOnDetail(),
            new Panel('Ədv Hesabatı', [
                EdvCalculation::make('Ədv Hesabatı','total_result')->hideFromIndex()
            ])
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

            new AssetsMetrics(null,$this,"Yeni aktivlər","new"),
            new AssetsMetrics(null,$this,"Toplam məbləğ","price"),
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
            new ContractFilter()
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
