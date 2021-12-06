<?php

namespace App\Nova;

use Eibrahimli\EdvCalculation\EdvCalculation;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use KossShtukert\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Yassi\NestedForm\NestedForm;

class Work extends Resource
{
    public static $model = \App\Models\Work::class;

    public static $title = 'id';

    public static $group = 'Mühasibatlıq';

    public static function label(): string
    {
        return 'İş və xidmətlər';
    }

    public static function singularLabel(): string
    {
        return 'İş və xidmət';
    }

    public static $search = [
        'id',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Müqavilə'), 'contract', Contract::class)->onlyOnIndex(),
            Select2::make(__('Müqavilə'), 'contract_id')
                ->options(\App\Models\Contract::all()->mapWithKeys(function ($contract) {
                    return [$contract->id => $contract->supplier->name." ".$contract->branch->name." ".$contract->contract_number];
                }))
                ->displayUsingLabels(),
            Text::make(__("Hesab Faktura Nömrəsi"),"invoice_number"),
            Text::make(__("EQF Nömrəsi"),"einvoice_number"),
            Date::make(__("EQF Tarixi"),"einvoice_date"),
            Boolean::make("Status","status")->trueValue('1')->falseValue( '0'),
            NestedForm::make('WorkInner')->heading('İş və xidmət yarat'),
            HasMany::make(__('İş və xidmətlər'), 'workInner', WorkInner::class)->onlyOnDetail(),
            new Panel('Ədv Hesabatı', [
                EdvCalculation::make('Ədv Hesabatı','total_result')->hideFromIndex()
            ])
        ];
    }

    public function cards(Request $request): array
    {
        return [];
    }

    public function filters(Request $request): array
    {
        return [];
    }

    public function lenses(Request $request): array
    {
        return [];
    }

    public function actions(Request $request): array
    {
        return [];
    }
}
