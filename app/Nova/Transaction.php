<?php

namespace App\Nova;

use App\Helpers\TransactionHelper;
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
use Laravel\Nova\Fields\Date;
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

    public static function redirectAfterCreate(NovaRequest $request, $resource): string
    {
        return '/resources/loans/'.$resource->model()->loan->id;
    }

    public function fields(Request $request): array
    {

        return array(
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Gozlenilen Mebleg', 'expected_price', function ($val) use($request) {
                if($val) return $val;

                if($this->service_fee) return $val;

                $allReportRelatedLoan = $this->getReport($request->viaResourceId);

                if($request->editMode == 'update' || !isset($allReportRelatedLoan)) return $val;

                if($allReportRelatedLoan->percentage_remainder > 0 || $allReportRelatedLoan->main_remainder > 0) {
                   return round((float) $allReportRelatedLoan->totalDept - $allReportRelatedLoan->percentage_remainder - $allReportRelatedLoan->main_remainder + $allReportRelatedLoan->penalty, 2);
                }

                return round($allReportRelatedLoan->totalDept + $allReportRelatedLoan->penalty, 2);
            })->readonly(),
            Text::make('Məbləğ','price')->rules(
                ['required', new CheckTransactionPaymentIsGreaterThanExpectedPrice($this->getReport($request->viaResourceId))]
            ),
            Boolean::make('Digər vətandaş tərəfindən ödəniş', 'is_civil'),
            NovaDependencyContainer::make(array(
                Text::make("Ad", 'name')->sortable(),
                Text::make('Soyad', 'surname')->sortable(),
                Text::make('Ata Adı', 'fathername')->sortable(),
                Text::make('Fin', 'fin')->sortable()->rules(['nullable', 'string', 'size:7']),
                Text::make('Ş.V. Seriya №', 'identity_number')->sortable(),
            ))->dependsOn('is_civil', 1),

            Text::make("Əsas məbləğ üzrə", 'main_price', function ($val) use($request) {

                if(gettype($val) == 'double') return $val;

                $allReportRelatedLoan = $this->getReport($request->viaResourceId);

                if($request->editMode == 'update' || !isset($allReportRelatedLoan)) return $val;

                return round($allReportRelatedLoan->mainDept-$allReportRelatedLoan->main_remainder,2) ?? $val;
            })
                ->readonly()
                ->sortable(),
            Text::make("Marağ faizi üzrə", 'interested_price', function ($val) use($request) {
                if(gettype($val) == 'double') return $val;

                $allReportRelatedLoan = $this->getReport($request->viaResourceId);

                if($request->editMode == 'update' || !isset($allReportRelatedLoan)) return $val;

                if(isset($allReportRelatedLoan->percentage_remainder) && $allReportRelatedLoan->percentage_remainder > 0 ) {
                    return number_format((float) $allReportRelatedLoan->percentDept - $allReportRelatedLoan->percentage_remainder, 2) ?? $val;
                }
                return (double) $allReportRelatedLoan->percentDept;
            })
                ->readonly()
                ->sortable(),
            Text::make("Hesablanmış cərimə", 'calculated_price', function ($val) use ($request){
                return $val ?: @$this->getReport($request->viaResourceId)->penalty;
            })->readonly()->sortable(),
            Text::make("Gecikmə gün sayısı", 'penalty_day' , function ($val) use ($request){
                return $val ?: @$this->getReport($request->viaResourceId)->penalty_day;
            })->readonly()
                ->sortable(),
            Text::make('Açıqlama','description')
                ->hideWhenCreating()
                ->readonly(),
            Text::make('Ödəməli olduğu tarix','shouldPay' , function ($value) use($request) {
                return $value ?: @$this->getReport($request->viaResourceId)->shouldPay;
            })->readonly(),
            BelongsTo::make('Kassir', 'user', User::class)->default(function () {
                return Auth::id();
            })->displayUsing(function () { return Auth::user()->name .' '.Auth::user()->surname; })->readonly(),
            BelongsTo::make('Kredit', 'loan', Loan::class),
        );
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
