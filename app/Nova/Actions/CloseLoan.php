<?php

namespace App\Nova\Actions;

use App\Models\Account;
use App\Models\Loan;
use App\Models\LoanReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Models\Transaction;

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

        $transaction = new Transaction();

        $transaction->calculated_price = 0;
        $transaction->expected_price = $fields->price;
        $transaction->price = $fields->price;
        $transaction->type = 'loan_closed';
        $transaction->loan_id = $model->id;
        $transaction->main_price = $fields->price;
        $transaction->interested_price = 0.00;
        $transaction->user_id = \Auth::id();
        $transaction->description = 'Kredit bağlanması';

        $transaction->saveQuietly();

        $accounts = Account::first();
        $accounts->balance += $transaction->price;

        $accounts->save();

        return Action::message('Kredit uğurlu şəkildə bağlanıldı');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $price = round($this->findMainDept(), '1');

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
