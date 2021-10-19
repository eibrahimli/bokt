<?php

namespace App\Nova;

use App\Nova\Options\Agriculture;
use App\Nova\Options\Consumption;
use App\Nova\Options\Production;
use App\Nova\Options\Service;
use App\Nova\Options\Trade;
use App\Nova\Options\Transportation;
use App\Nova\Options\Trick;
use Illuminate\Http\Request;
use KossShtukert\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Zareismail\NovaWizard\Contracts\Wizard;
use Zareismail\NovaWizard\Step;

class Loan extends Resource implements Wizard
{
    public static $model = \App\Models\Loan::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public static function singularLabel(): string
    {
        return 'Kredit';
    }

    public static function label(): string
    {
        return 'Kreditlər';
    }

    public function fields(Request $request): array
    {
        return [
            (new Step('Kredit', [

                ID::make(__('ID'), 'id')->sortable(),
                NovaBelongsToDepend::make('Məhsulun adı','product',Product::class)
                    ->options(\App\Models\Product::all()),
                Number::make('Faiz', 'percentage'),
                Number::make('Müddət (Ay)','month'),
                Currency::make('Qiymət','price'),

            ]))->withToolbar(),
            new Step('Qirov haqqında məlumat', [
                Text::make('Girov Adı', 'collateral_name'),
                BelongsTo::make('Əyyar','trick', Trick::class)->showCreateRelationButton(),
                Text::make('Qram', 'gram'),
                Currency::make('Dəyər','collateral_price')->sortable(),
            ]),
            new Step('Müştərinin biznes sahəsi', [
                BelongsTo::make('İstehlak','consumption', Consumption::class)->showCreateRelationButton(),
                BelongsTo::make('İstehsal','production', Production::class)->showCreateRelationButton(),
                BelongsTo::make('Kənd Təsərrüfatı','agriculture', Agriculture::class)->showCreateRelationButton(),
                BelongsTo::make('Ticarət','trade', Trade::class)->showCreateRelationButton(),
                BelongsTo::make('Xidmət','service', Service::class)->showCreateRelationButton(),
                BelongsTo::make('Nəqliyyat','transportation', Transportation::class)->showCreateRelationButton(),
                Boolean::make("Kredit prosesini təsdiqləmək",'status')->rules(['required'])
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
