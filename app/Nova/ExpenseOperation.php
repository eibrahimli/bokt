<?php

namespace App\Nova;

use App\Nova\Filters\ContractAccountFilter;
use App\Nova\Filters\ContractAdminFilter;
use App\Nova\Filters\ContractBrachFilter;
use App\Nova\Filters\ContractFilter;
use App\Nova\Filters\ContractSupplierFilter;
use App\Nova\Filters\CreditFilter;
use App\Nova\Filters\DebetFilter;
use App\Nova\Metrics\ExpenseOperationsSum;
use Codebykyle\CalculatedField\BroadcasterField;
use Codebykyle\CalculatedField\ListenerField;
use Eibrahimli\CalculationField\CalculationField;
use Eibrahimli\CustomTotalField\CustomTotalField;
use Hubertnnn\LaravelNova\Fields\DynamicSelect\DynamicSelect;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NrmlCo\NovaBigFilter\NovaBigFilter;

class ExpenseOperation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ExpenseOperation::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $group = 'Mühasibatlıq';

    public static function label(): string
    {
        return 'Məxaric əməliyyatları'; // TODO: Change the autogenerated stub
    }

    public static function singularLabel(): string
    {
        return 'Məxaric əməliyyatları'; // TODO: Change the autogenerated stub
    }


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
            /*BelongsTo::make(__('Alıcı (filial)'), 'branch', Branch::class),
            BelongsTo::make(__('Təchizatçı'), 'supplier', Supplier::class),
            BelongsTo::make(__('Müqavilə'), 'work', Work::class),*/

            DynamicSelect::make('Kreditor', 'supplier_id')
                ->options(\App\Models\Supplier::pluck("name","id")->all()),
            //->rules('required'),

            DynamicSelect::make('Filial', 'branch_id')
                ->options(\App\Models\Branch::pluck("name","id")->all()),
            //->rules('required'),

            DynamicSelect::make('Hesab faktura', 'work_id')
                ->dependsOn(['supplier_id', 'branch_id'])
                ->options(function($values) {
                    $contracts = \App\Models\Work::whereNull("deleted_at");
                    if(isset($values["supplier_id"])){
                        $contracts = $contracts->where("supplier_id",$values["supplier_id"]);
                    }

                    if(isset($values["branch_id"])){
                        $contracts = $contracts->where("branch_id",$values["branch_id"]);
                    }

                    $contracts =  $contracts->pluck("invoice_number","id");
                    return $contracts;
                }),

/*            Text::make(__("Ödəniş məbləği"),"price"),
            Text::make(__("ƏDV dərəcəsi"),"edv_percent"),
            Text::make(__("ƏDV məbləği"),"edv_price"),*/


            BroadcasterField::make('Ödəniş məbləği', 'price')->setType('string'),
            BroadcasterField::make('ƏDV dərəcəsi', 'edv_percent'),

         /*   ListenerField::make('ƏDV məbləği', 'edv_price')
                ->calculateWith(function (Collection $values) {
                    $subtotal = $values->get('price');
                    $tax = $values->get('edv_percent');
                    return floatval((($subtotal*$tax)/100));
                }),*/

            ListenerField::make('Ümumi məbləğ', 'total_price')
                ->calculateWith(function (Collection $values) {
                    $subtotal = $values->get('price');
                    $tax = $values->get('edv_percent');
                    return floatval(($subtotal + ($subtotal*$tax)/100));
                }),
            BelongsTo::make(__('Hesab'), 'account', Account::class),

            BelongsTo::make(__('Müxabirləşmə (Debet)'), 'debetAccount', DcAccount::class)->showCreateRelationButton(),
            BelongsTo::make(__('Müxabirləşmə (Kredit)'), 'creditAccount', DcAccount::class)->showCreateRelationButton(),

            Date::make(__("Ödəniş tarixi"),"payment_date"),
/*            Text::make(__("Ödəniş metodu"),"operation_method"),*/
            Select::make(__("Ödəniş metodu"),"operation_method")->options([
                '0' => 'Nəğd',
                '1' => 'Bank hesabı',
            ])->displayUsingLabels(),
            Text::make(__("Ödəniş təyinatı"),"purpose_payment"),
            BelongsTo::make(__('Admin'), 'user', User::class),

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
            new ExpenseOperationsSum(),
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
            new ContractAccountFilter(),
            new ContractBrachFilter(),
            new ContractSupplierFilter(),
            new ContractFilter(),
            new DebetFilter(),
            new CreditFilter(),
            new ContractAdminFilter()

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
