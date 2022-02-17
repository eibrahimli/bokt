<?php

namespace App\Nova\Actions;

use App\Models\Loan;
use App\Models\LoanReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class CloseLoan extends Action
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


    public function handle(ActionFields $fields, Collection $models): array
    {
        $model = $models->first();

        $model->closed = 0;

        if($model->rescheduled):
            $model->rescheduled_payed_balance += $fields->price;
        else:
            $model->payed_balance += $fields->price;
        endif;

        $model->loanReports()->active()->update(['paid' => true, 'not_paid_percentage_interest' => true]);

        $model->save();

        return Action::redirect(url('/resources/loans'));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $price = round($this->findMainDept(), '2');

        return [
            \Laravel\Nova\Fields\Currency::make('Qəbul ediləcək məbləğ','price')
                ->withMeta(['value' => $price])
                ->currency('AZN')
                ->readonly()
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
        return 'Krediti bağla';
    }
}
