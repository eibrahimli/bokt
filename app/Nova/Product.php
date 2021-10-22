<?php

namespace App\Nova;

use App\Models\Loan;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

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

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Ad', 'name'),
            HasMany::make('Kreditlər', 'loans', \App\Nova\Loan::class)
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
