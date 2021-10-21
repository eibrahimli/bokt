<?php

namespace App\Nova;

use App\Nova\Metrics\NewTransaction;
use Eibrahimli\CustomerLoanField\CustomerLoanField;
use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Transaction extends Resource
{
    use HasDependencies;

    public static $model = \App\Models\Transaction::class;

    public static $title = 'id';

    public static $displayInNavigation = false;

    public static $search = [
        'id',
    ];

    public static function singularLabel(): string
    {
        return 'Tranzaksiya';
    }
    public static function label(): string
    {
        return 'Tranzaksiyalar';
    }

    public function fields(Request $request): array
    {
        return array(
            ID::make(__('ID'), 'id')->sortable(),
            CustomerLoanField::make('Dəyər', 'price')->sortable(),
            Boolean::make('Digər vətandaş tərəfindən ödəniş', 'is_civil'),
            NovaDependencyContainer::make(array(
                Text::make("Ad", 'name')->sortable(),
                Text::make('Soyad', 'surname')->sortable(),
                Text::make('Ata Adı', 'fathername')->sortable(),
            ))->dependsOn('is_civil', 1),

            Text::make("Əsas məbləğ üzrə", 'main_price')
                ->readonly()
                ->sortable(),
            Text::make("Marağ faizi üzrə", 'interested_price')
                ->readonly()
                ->sortable(),
            Text::make("Hesablanmış cərimə", 'calculated_price')
                ->readonly()
                ->sortable(),
            BelongsTo::make('İstifadəçi', 'user', User::class)->default(function () {
                return Auth::id();
            })->displayUsing(function () { return Auth::user()->name .' '.Auth::user()->surname; })->readonly(),
            BelongsTo::make('Kredit', 'loan', Loan::class),
        );
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new NewTransaction()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
