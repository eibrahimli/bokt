<?php

namespace App\Nova;

use App\Models\Loan;
use Armincms\Json\Json;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use OptimistDigital\NovaTableField\Table;

class Product extends Resource
{

    public static $model = \App\Models\Product::class;

    public static $title = 'name';
    public static $displayInNavigation = false;

    public static function singularLabel(): string
    {
        return 'Məhsul';
    }

    public static function label(): string
    {
        return 'Məhsullar';
    }

    public static $search = [
        'id','name'
    ];

    public static function redirectAfterCreate(NovaRequest $request, $resource): string
    {
        return '/resources/'.static::uriKey();
    }

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Ad', 'name'),
            Number::make('Faiz', 'percentage'),
            Number::make('Minimum məbləğ', 'min_price'),
            Number::make('Maximum məbləğ', 'max_price'),
            Number::make('Minimum müddət', 'min_date'),
            Number::make('Maximum müddət', 'max_date'),
            Number::make('Xidmət haqqı','service_fee'),
            Boolean::make('Status', 'status'),
            HasMany::make('Kreditlər', 'loans', \App\Nova\Loan::class),
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
        return [
            (new DownloadExcel())->withFilename('Məhsullar'.time().'xlsx')->withHeadings()->allFields()
        ];
    }
}
