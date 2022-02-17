<?php

namespace App\Nova\Actions;

use App\Helpers\LoanHelper;
use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class CreateReScheduleLoanAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * @var Loan
     */
    private $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $loan = $models->first();
        $loanAmount = LoanHelper::findMainDept($loan);
        $month = $fields->month;
        $percentage = $models->first()->product->percentage;

        $report = (new \App\Helpers\CreditHelper($month,$loanAmount,$percentage,0))->getFormatedData();

        $loan->loanReports()->where('paid', 0)->delete();

        $loan->loanReports()->createMany($report);

        $loan->rescheduled = true;
        $loan->rescheduled_report = $loan->loanReports;
        $loan->rescheduled_price = $loanAmount;
        $loan->rescheduled_month = $month;
        $loan->current_main_price = $loanAmount;

        $loan->rescheduled_whole_payable_balance = collect($report)->sum('totalDept') + $report[0]['service_fee'];

        $loan->saveQuietly();
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {

        return [
            Text::make('Məhsul','product')->withMeta(['value' => @$this->loan->product->name])->readonly(),
            Currency::make('Qalıq əsas məbləğ','price')
                ->withMeta(['value' => round($this->findMainDept(),'2')])
                ->currency('AZN')
                ->readonly(),
            Number::make('Faiz','percentage')
                ->readonly()
                ->withMeta(['value' => @$this->loan->product->percentage]),
            Number::make('Ay', 'month')->rules(['required'])
        ];
    }

    protected function findMainDept() {
        $reports = $this->loan->loanReports()->active()->get();

        $sum = $reports->sum('mainDept');

        $mainDeptRemainder = $reports->sum('main_remainder');

        return $sum - $mainDeptRemainder;
    }

    public function name(): string
    {
        return 'Yeni kredit cədvəli yarat';
    }
}
