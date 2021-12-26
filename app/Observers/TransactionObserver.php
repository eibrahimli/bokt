<?php

namespace App\Observers;

use App\Models\Loan;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionObserver
{

    public function created(Transaction $transaction)
    {
        $loan = $transaction->loan;
        $loanReport = $transaction->loan->loanReports()->active()->whereNull('deleted_at')->whereNull('paid_at')->first();

        if($loanReport->totalDept == $transaction->price) {
            $loanReport->paid = true;
            $loanReport->paid_at = now();
            $loan->payed_balance += $transaction->price;
            $loan->unsetEventDispatcher();
            $loan->save();
            $loanReport->unsetEventDispatcher();
            $loanReport->save();
        }

        $transaction->main_price = $loanReport->mainDept;
        $transaction->interested_price = $loanReport->percentDept;
        $transaction->expected_price = $loanReport->totalDept;

        $transaction->unsetEventDispatcher();
        $transaction->save();

    }

    public function updated(Transaction $transaction)
    {


    }

    public function deleted(Transaction $transaction)
    {
        //
    }

    public function restored(Transaction $transaction)
    {
        //
    }

    public function forceDeleted(Transaction $transaction)
    {
        //
    }
}
