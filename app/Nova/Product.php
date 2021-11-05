<?php

namespace App\Nova;

use App\Models\Loan;
use Armincms\Json\Json;
use Illuminate\Http\Request;
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

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Ad', 'name'),
            HasMany::make('Kreditlər', 'loans', \App\Nova\Loan::class),
            Table::make('Countries')

                // Optional:
                //->disableAdding() // Disable adding new rows and columns
                //->disableDeleting() // Disable deleting rows and columns
                ->minRows(1) // The minimum number of rows in the table
                ->maxRows(10) // The maximum number of rows in the table
                ->minColumns(1) // The minimum number of columns in the table
                ->maxColumns(10) // The maximum number of columns in the table,
            ,Table::make('Languages')

                // Optional:
                //->disableAdding() // Disable adding new rows and columns
                //->disableDeleting() // Disable deleting rows and columns
                ->minRows(1) // The minimum number of rows in the table
                ->maxRows(10) // The maximum number of rows in the table
                ->minColumns(1) // The minimum number of columns in the table
                ->maxColumns(10) // The maximum number of columns in the table
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
