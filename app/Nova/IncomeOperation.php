<?php

namespace App\Nova;

use App\Nova\Filters\ContractBrachFilter;
use App\Nova\Filters\ContractFilter;
use App\Nova\Filters\ContractSupplierFilter;
use App\Nova\Filters\CreditFilter;
use App\Nova\Filters\DebetFilter;
use App\Nova\Metrics\IncomeOperationsSum;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NrmlCo\NovaBigFilter\NovaBigFilter;

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
            ID::make(__('ID'), 'id')->sortable(),/*
            BelongsTo::make(__('Alıcı (filial)'), 'branch', Branch::class),
            BelongsTo::make(__('Təchizatçı'), 'supplier', Supplier::class),
            BelongsTo::make(__('Müqavilə'), 'contract', Contract::class),*/
            BelongsTo::make(__('Hesabdan'), 'accountFrom', Account::class)->nullable(),
            DynamicSelect::make('Kimdən', 'supplier_id')
                ->options(\App\Models\Supplier::pluck("name","id")->all()),
            //->rules('required'),
            BelongsTo::make(__('Hesaba'), 'accountTo', Account::class),
            BelongsTo::make(__('Müxabirləşmə (Debet)'), 'debetAccount', DcAccount::class)->showCreateRelationButton(),
            BelongsTo::make(__('Müxabirləşmə (Kredit)'), 'creditAccount', DcAccount::class)->showCreateRelationButton(),
            Text::make(__("Ödəniş məbləği"),"price"),
            Date::make(__("Ödəniş tarixi"),"payment_date"),
/*            Text::make(__("Ödəniş metodu"),"operation_method"),*/
            Text::make(__("Ödəniş təyinatı"),"purpose_payment"),


            DynamicSelect::make('Filial', 'branch_id')
                ->options(\App\Models\Branch::pluck("name","id")->all()),
            //->rules('required'),

            DynamicSelect::make('Müqavilə', 'work_id')
                ->dependsOn(['supplier_id', 'branch_id'])
                ->options(function($values) {
                    $contracts = \App\Models\Work::whereNull("deleted_at");
                    if(isset($values["supplier_id"])){
                        $contracts = $contracts->where("supplier_id",$values["supplier_id"]);
                    }

                    if(isset($values["branch_id"])){
                        $contracts = $contracts->where("branch_id",$values["branch_id"]);
                    }

                    $contracts =  $contracts->pluck("contract_number","id");
                    return $contracts;
                }),
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
            new IncomeOperationsSum(),
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
            new ContractFilter(),
            new DebetFilter(),
            new CreditFilter()
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
        return [
            (new DownloadExcel())->withHeadings(),

        ];
    }
}
