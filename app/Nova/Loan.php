<?php

namespace App\Nova;

use App\Nova\Actions\AcceptPayment;
use App\Nova\Metrics\LoanIsApproved;
use App\Nova\Metrics\NewLoan;
use App\Nova\Options\Agriculture;
use App\Nova\Options\Consumption;
use App\Nova\Options\Production;
use App\Nova\Options\Service;
use App\Nova\Options\Trade;
use App\Nova\Options\Transportation;
use App\Nova\Options\Trick;
use App\Rules\BooleanHasToBeTrue;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Eibrahimli\MonthlyCreditPaymentReport\MonthlyCreditPaymentReport;
use Eibrahimli\PercentageField\PercentageField;
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
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;
use Titasgailius\SearchRelations\SearchesRelations;
use Yassi\NestedForm\NestedForm;

class Loan extends Resource
{
    use SearchesRelations;
    public static $model = \App\Models\Loan::class;

    public static $title = 'id';
    public static $displayInNavigation = false;

    public static $search = [
        'id'
    ];

    public static $searchRelations = [
        'customer' => ['id','name', 'surname', 'fin']
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
            BelongsTo::make('Müştəri','customer', Customer::class),
            NovaBelongsToDepend::make('Məhsulun adı', 'product', Product::class)
                ->options(\App\Models\Product::all()),
            PercentageField::make('Faiz', 'percentage')->readonly(),
            Number::make('Müddət (Ay)', 'month'),
            Currency::make('Qiymət', 'price')->currency('AZN'),
            Currency::make('Ümumi ödəniləcək məbləğ','whole_payable_balance')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->currency('AZN'),
            Currency::make('Ödənilən məbləğ','payed_balance')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->currency('AZN'),
            new Panel('Kreditin ay ba ay hesabatı', [
                MonthlyCreditPaymentReport::make('credit_report')->hideFromIndex(),
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
                    ->rules(['required', new BooleanHasToBeTrue('Kredit prosesini təsdiqləməlisiniz')]),
                HasMany::make('Ödənişlər', 'transactions', Transaction::class),
                HasMany::make('Girovlar', 'collaterals', Collateral::class),
            ])

        ];
    }

    public function cards(Request $request): array
    {
        return [
            new NewLoan(),
            new LoanIsApproved(null,'Təsdiqlənmiş kreditlər',true),
            new LoanIsApproved(null,'Təsdiqlənməmiş kreditlər',false),
            (new StackedChart())
                ->title('Kreditlər')
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Kredit #1',
                    'backgroundColor' => '#ffcc5c',
                    'data' => [30, 70, 80],
                ],[
                    'barPercentage' => 0.5,
                    'label' => 'Kredit #2',
                    'backgroundColor' => '#ff6f69',
                    'data' => [40, 62, 79],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Aug', 'Sen', 'Okt' ]
                    ],
                ]),
        ];
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
            (new DownloadExcel())->withFilename('Kreditlər'.time().'xlsx')->withHeadings()->allFields(),
//            new AcceptPayment()
        ];
    }
}
