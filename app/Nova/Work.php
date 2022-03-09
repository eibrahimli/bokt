<?php

namespace App\Nova;

use App\Nova\Filters\ContractBrachFilter;
use App\Nova\Filters\ContractFilter;
use App\Nova\Filters\ContractNumberFilter;
use App\Nova\Filters\ContractPriceFilter;
use App\Nova\Filters\ContractSupplierFilter;
use App\Nova\Metrics\WorksMetrics;
use Eibrahimli\EdvCalculation\EdvCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use KossShtukert\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NrmlCo\NovaBigFilter\NovaBigFilter;
use Yassi\NestedForm\NestedForm;

class Work extends Resource
{
    public static $model = \App\Models\Work::class;

    public static $title = 'invoice_number';

    public static $group = 'Mühasibatlıq';

    public static function label(): string
    {
        return 'Hesab fakturalar';
    }

    public static function singularLabel(): string
    {
        return 'Hesab faktura';
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Alıcı (filial)'), 'branch', Branch::class)->showCreateRelationButton(),
            BelongsTo::make(__('Kreditor'), 'supplier', Supplier::class)->showCreateRelationButton(),
            Text::make(__("Müqavilə Nömrəsi"),"contract_number"),
            Date::make(__("Müqavilə tarixi"),"contract_date"),
            Date::make(__("Müqavilə başlayır"),"contract_begin"),
            Date::make(__("Müqavilə bitir"),"contract_end"),
            Text::make(__("Hesab Faktura Nömrəsi"),"invoice_number"),
            Date::make(__("Hesab Faktura tarixi"),"invoice_date"),
            NestedForm::make(__('İş və xidmətlər'),'WorkInner',WorkInner::class)->heading('İş və xidmət siyahısı')->rules("required")->min(1),
            HasMany::make(__('İş və xidmətlər'), 'workInner', WorkInner::class)->onlyOnDetail(),
            new Panel('Yekun', [
                EdvCalculation::make('Yekun','total_result')->hideFromIndex()
            ])
        ];
    }

    public function cards(Request $request): array
    {
        return [

            new WorksMetrics(null,$this,"Yeni müqavilələr","new"),
            new WorksMetrics(null,$this,"Toplam məbləğ","price"),
            new NovaBigFilter(),

        ];
    }

    public function filters(Request $request): array
    {
        return [
            new ContractBrachFilter(),
            new ContractSupplierFilter(),
            new ContractNumberFilter(),
            new ContractPriceFilter()
        ];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {

        return [
            (new DownloadExcel())->withHeadings(),
        ];
    }
}
