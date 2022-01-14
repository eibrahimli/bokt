<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Loan;
use App\Models\LoanReport;
use App\Models\Registry;
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
            $loan->saveQuietly();
            $loanReport->saveQuietly();
        } elseif ($loanReport->totalDept < $transaction->price) {
            $loanReport->paid = true;
            $loanReport->paid_at = now();
            $loan->payed_balance += $transaction->price;
            $loan->saveQuietly();
            $loanReport->saveQuietly();

            $nextMonthId = $loanReport->id + 1;
            // Find next month report
            $loanNext = LoanReport::find($nextMonthId);
            //Update percentage remainder
            $loanNext->percentage_remainder = (double) $transaction->price - $loanReport->totalDept;
            $loanNext->saveQuietly();
        }

        // Hesablardan məbləği çıx
        $accounts = Account::first();

        $accounts->balance += $transaction->price;

        $accounts->saveQuietly();

        // Add Data to Reyestr

        $reyester = new Registry();

        $reyester->amount = $transaction->price;
        $reyester->debet = 123;
        $reyester->credit = 124;
        $reyester->customer_id = $loan->customer->id;
        $reyester->product_id = $loan->product->id;
        $reyester->product_name = $loan->product->name;

        $reyester->saveQuietly();

        $transaction->main_price = $loanReport->mainDept;
        $transaction->interested_price = $loanReport->percentDept;
        $transaction->expected_price = $loanReport->totalDept;

        $transaction->saveQuietly();

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
