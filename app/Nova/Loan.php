<?php

namespace App\Nova;

use App\Nova\Options\Agriculture;
use App\Nova\Options\Consumption;
use App\Nova\Options\Production;
use App\Nova\Options\Service;
use App\Nova\Options\Trade;
use App\Nova\Options\Transportation;
use App\Nova\Options\Trick;
use App\Rules\BooleanHasToBeTrue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
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

class Loan extends Resource
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
            ID::make(__('ID'), 'id')->sortable(),

                NovaBelongsToDepend::make('Məhsulun adı', 'product', Product::class)
                    ->options(\App\Models\Product::all()),
                Number::make('Faiz', 'percentage'),
                Number::make('Müddət (Ay)', 'month'),
                Currency::make('Qiymət', 'price')->currency('AZN'),

            new Panel('Qirov haqqında məlumat', [
                Text::make('Girov Adı', 'collateral_name'),
                BelongsTo::make('Əyyar', 'trick', Trick::class)->showCreateRelationButton(),
                Text::make('Qram', 'gram'),
                Currency::make('Dəyər', 'collateral_price')->currency('AZN')->sortable(),
            ]),
            new Panel('Müştərinin biznes sahəsi', [

                BelongsTo::make('İstehlak', 'consumption', Consumption::class)
                    ->hideFromIndex()
                    ->showCreateRelationButton(),
                BelongsTo::make('İstehsal', 'production', Production::class)
                    ->hideFromIndex()
                    ->showCreateRelationButton(),
                BelongsTo::make('Kənd Təsərrüfatı', 'agriculture', Agriculture::class)
                    ->hideFromIndex()
                    ->showCreateRelationButton(),

                BelongsTo::make('Ticarət', 'trade', Trade::class)
                    ->hideFromIndex()
                    ->showCreateRelationButton(),
                BelongsTo::make('Xidmət', 'service', Service::class)
                    ->hideFromIndex()
                    ->showCreateRelationButton(),
                BelongsTo::make('Nəqliyyat', 'transportation', Transportation::class)
                    ->hideFromIndex()
                    ->showCreateRelationButton(),
                Boolean::make("Kredit prosesini təsdiqləmək", 'status')
                    ->rules(['required', new BooleanHasToBeTrue('Kredit prosesini təsdiqləməlisiniz')])
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
