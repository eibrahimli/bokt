<?php

namespace App\Nova;

use App\Helpers\LoanHelper;
use App\Nova\Actions\AcceptPayment;
use App\Nova\Actions\AcceptServiceFeeForLoan;
use App\Nova\Actions\CloseLoan;
use App\Nova\Actions\CreateReScheduleLoanAction;
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
use App\Rules\CheckLoanDateAndPriceRange;
use Coroowicaksono\ChartJsIntegration\StackedChart;
use Eibrahimli\MonthlyCreditPaymentReport\MonthlyCreditPaymentReport;
use Eibrahimli\PercentageField\PercentageField;
use Eminiarts\Tabs\Tabs;
use Illuminate\Database\Eloquent\Builder;
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

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        return $query->active()->unclosed();
    }

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
        $product = $request->product ? $this->getProduct($request->product) : null;
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Filial'), function () {
                return $this->id.' - '.$this->branch->name;
            })->exceptOnForms()->sortable(),

            BelongsTo::make('Müştəri','customer', Customer::class),
            NovaBelongsToDepend::make('Məhsulun adı', 'product', Product::class)
                ->options(\App\Models\Product::all()),

            Tabs::make('Cədvəllər',array_merge(@$this->rescheduled ? [
                    new Panel('Yeni Cədvəl',array_merge($this->reScheduledFields($request),[
                            MonthlyCreditPaymentReport::make('rescheduled_report')
                                ->hideFromIndex()
                                ->hideWhenUpdating()
                                ->hideWhenCreating(),
                        ])
                    ),
                ] : []
                ,[
                    new Panel('İlkin Cədvəl', [
                        PercentageField::make('Faiz', 'percentage')
                            ->hideFromIndex($this->rescheduled)
                            ->readonly(),
                        Number::make('Müddət (Ay)', 'month')->rules([
                            'required', 'integer',$product ? new CheckLoanDateAndPriceRange($product, 'month') : ''
                        ])->hideFromIndex($this->rescheduled),
                        Currency::make('Məbləğ', 'price')->rules([
                            'required', 'integer',$product ? new CheckLoanDateAndPriceRange($product, 'price') : ''
                        ])->hideFromIndex($this->rescheduled)->currency('AZN'),
                        Currency::make('Ümumi ödəniləcək məbləğ','whole_payable_balance')
                            ->hideWhenCreating()
                            ->hideWhenUpdating()
                            ->hideFromIndex($this->rescheduled)
                            ->currency('AZN'),
                        Currency::make('Ödənilən məbləğ','payed_balance')
                            ->hideWhenCreating()
                            ->hideWhenUpdating()
                            ->hideFromIndex($this->rescheduled)
                            ->currency('AZN'),

                        Currency::make('Qalıq borc',function () {
                            return $this->whole_payable_balance - $this->payed_balance;
                        })
                            ->hideWhenCreating()
                            ->hideWhenUpdating()
                            ->hideFromIndex($this->rescheduled)
                            ->currency('AZN'),

                        Currency::make('Qalıq əsas məbləğ','current_main_price')
                            ->hideWhenCreating()
                            ->hideWhenUpdating()
                            ->hideFromIndex($this->rescheduled)
                            ->currency('AZN'),

                        MonthlyCreditPaymentReport::make('credit_report')->hideFromIndex(),
                    ]),

                ])),
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
            ]),
            NestedForm::make('Girovlar', 'collaterals', Collateral::class),
            Tabs::make('Relations', [
                HasMany::make('Ödənişlər', 'transactions', Transaction::class),
                HasMany::make('Girovlar', 'collaterals', Collateral::class),
            ]),

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

            new CreateReScheduleLoanAction($this->model()),
            new CloseLoan($this->model()),
            new AcceptServiceFeeForLoan($this->model())
//            new AcceptPayment()
        ];
    }

    protected function getProduct($id) {
        return \App\Models\Product::find($id);
    }

    protected function reScheduledFields($request) {
        return [
            PercentageField::make('Faiz', 'percentage')->readonly(),
            Number::make('Müddət (Ay)', 'rescheduled_month')->showOnIndex($this->rescheduled)->exceptOnForms(),
            Currency::make('Məbləğ', 'rescheduled_price')
                ->exceptOnForms()
                ->currency('AZN'),
            Currency::make('Ümumi ödəniləcək məbləğ','rescheduled_whole_payable_balance')
                ->exceptOnForms()
                ->currency('AZN'),
            Currency::make('Ödənilən məbləğ','rescheduled_payed_balance')
                ->exceptOnForms()
                ->currency('AZN'),

            Currency::make('Qalıq borc',function () {
                return $this->rescheduled_whole_payable_balance - $this->rescheduled_payed_balance;
            })
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->currency('AZN'),

            Currency::make('Qalıq əsas məbləğ',function () {
                return LoanHelper::findMainDept($this->model());
            })
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->currency('AZN'),
        ];
    }
}
