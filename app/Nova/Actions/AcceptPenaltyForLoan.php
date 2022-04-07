<?php

namespace App\Nova\Actions;

use App\Helpers\LoanHelper;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Currency;

class AcceptPenaltyForLoan extends Action
{
    use InteractsWithQueue, Queueable;

    private $loan;
    public $name = 'Cərimə ödənişi';

    public function __construct(Model $loan)
    {
        $this->loan = $loan;
    }


    public function handle(ActionFields $fields, Collection $models)
    {
        $model = $models->first();

        $penalty = $model->loanPenalties()->unPaid()->first();

        $transaction = new Transaction();

        $transaction->calculated_price = $fields->calculated_price;
        $transaction->expected_price = $penalty->price - $penalty->price_remainder;
        $transaction->price = $fields->calculated_price;
        $transaction->type = 'penalty';
        $transaction->loan_id = $model->id;
        $transaction->main_price = 0.00;
        $transaction->interested_price = 0.00;
        $transaction->user_id = Auth::id();
        $transaction->description = 'Cərimə ödənişi';

        if ($model->rescheduled):
            $model->rescheduled_payed_balance += $transaction->price;
        else:
            $model->payed_balance += $transaction->price;
        endif;

        $model->saveQuietly();

        $transaction->saveQuietly();

        $penalty->price_remainder += $fields->calculated_price;

        if (round($penalty->price,1) <= round($fields->calculated_price + $penalty->price_remainder,1) ):
            $penalty->paid = true;
            $penalty->paid_at = now();
        endif;

        $penalty->saveQuietly();
    }

    public function fields()
    {
        $penalty = $this->loan->loanPenalties()->unPaid()->first();

        return [
            Currency::make('Cərimə məgləğ   i', 'price')
                ->readonly()
                ->withMeta(['value' => round($penalty->price - $penalty->price_remainder,1)])
                ->currency('AZN'),
            Currency::make('Məbləğ', 'calculated_price')
                ->currency('AZN')
        ];
    }

}
