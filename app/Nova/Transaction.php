<?php

namespace App\Nova;

use App\Models\LoanReport;
use App\Nova\Metrics\NewTransaction;
use App\Rules\CheckTransactionPaymentIsGreaterThanExpectedPrice;
use Coroowicaksono\ChartJsIntegration\LineChart;
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
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

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
        return 'Ödəniş';
    }
    public static function label(): string
    {
        return 'Ödənişlər';
    }

    public function fields(Request $request): array
    {

        return array(
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Gozlenilen Mebleg', 'expected_price', function ($val) use($request) {

                $allReportRelatedLoan = $this->getReport($request->viaResourceId);

                if(!isset($request->editMode) || !isset($allReportRelatedLoan)) return $val;

                if($allReportRelatedLoan->percentage_remainder > 0) {
                   return (float) $allReportRelatedLoan->totalDept - $allReportRelatedLoan->percentage_remainder;
                }

                return $allReportRelatedLoan->totalDept;
            })->readonly(),
            Text::make('Məbləğ','price')->rules(new CheckTransactionPaymentIsGreaterThanExpectedPrice($this->getReport($request->viaResourceId))),
            Boolean::make('Digər vətandaş tərəfindən ödəniş', 'is_civil'),
            NovaDependencyContainer::make(array(
                Text::make("Ad", 'name')->sortable(),
                Text::make('Soyad', 'surname')->sortable(),
                Text::make('Ata Adı', 'fathername')->sortable(),
                Text::make('Fin', 'fin')->sortable()->rules(['required','nullable', 'string', 'size:7']),
                Text::make('Ş.V. Seriya №', 'identity_number')->sortable(),
            ))->dependsOn('is_civil', 1),

            Text::make("Əsas məbləğ üzrə", 'main_price', function ($val) use($request) {
                $allReportRelatedLoan = $this->getReport($request->viaResourceId);

                if(!isset($request->editMode) || !isset($allReportRelatedLoan)) return $val;

                return $allReportRelatedLoan->mainDept ?? $val;
            })
                ->readonly()
                ->sortable(),
            Text::make("Marağ faizi üzrə", 'interested_price', function ($val) use($request) {
                $allReportRelatedLoan = $this->getReport($request->viaResourceId);

                if(!isset($request->editMode) || !isset($allReportRelatedLoan)) return $val;

                if(isset($allReportRelatedLoan->percentage_remainder) && $allReportRelatedLoan->percentage_remainder > 0 ) {
                    return number_format((float) $allReportRelatedLoan->percentDept - $allReportRelatedLoan->percentage_remainder, 2) ?? $val;
                }
                return (double) $allReportRelatedLoan->percentDept;
            })
                ->readonly()
                ->sortable(),
            Text::make("Hesablanmış cərimə", 'calculated_price', fn() => 0)
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
            new NewTransaction(),
            (new LineChart())
                ->title('Tranzaksiyalar')
                ->animations([
                    'enabled' => true,
                    'easing' => 'easeinout',
                ])
                ->series(array([
                    'barPercentage' => 0.5,
                    'label' => 'Oratala Satış #1',
                    'borderColor' => '#f7a35c',
                    'data' => [80, 90, 80, 40, 62, 79, 79, 90, 90, 90, 92, 91],
                ],[
                    'barPercentage' => 0.5,
                    'label' => 'Ortalama Satış #2',
                    'borderColor' => '#90ed7d',
                    'data' => [90, 80, 40, 22, 79, 129, 30, 40, 90, 92, 91, 80],
                ]))
                ->options([
                    'xaxis' => [
                        'categories' => [ 'Jan', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct' ]
                    ],
                ]),
        ];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [
            (new DownloadExcel())->withFilename('Tranzaksiyalar'.time().'xlsx')->withHeadings()->allFields()
        ];
    }

    protected function getReport($id) {
        return LoanReport::where('loan_id', $id)
            ->active()
            ->whereNull('deleted_at')
            ->first();
    }
}
