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
        $service_fee = $loanReport->service_fee ?? false;

        if(($loanReport->totalDept - $loanReport->percentage_remainder - $loanReport->main_remainder) + ($service_fee ?? 0) == $transaction->price) {
            $loanReport->paid = true;
            $loanReport->paid_at = now();
            $loan->payed_balance += $transaction->price;

            $loanReport->saveQuietly();

        } elseif (($loanReport->totalDept - $loanReport->percentage_remainder - $loanReport->main_remainder) + ($service_fee ?? 0) < $transaction->price) {
            $loanReport->paid = true;
            $loanReport->paid_at = now();
            $loan->payed_balance += $transaction->price;
            $loan->saveQuietly();
            $loanReport->saveQuietly();

            $price = $transaction->price - (($loanReport->totalDept - $loanReport->percentage_remainder - $loanReport->main_remainder) + ($service_fee ?? 0));

            $this->handleLoanReport($loanReport,$transaction, $price);
        }

        $loan->credit_report = $loan->loanReports;
        $loan->saveQuietly();

        // Hesablardan məbləği çıx
        $this->updateAccounts($transaction);

        // Add Data to Reyestr
        $this->updateRegistry($transaction, $loan);

        $transaction->main_price = $loanReport->mainDept;
        $transaction->interested_price = $loanReport->percentDept;
        $transaction->expected_price = $loanReport->totalDept;

        $transaction->saveQuietly();

    }

    protected function handleLoanReport(LoanReport $loanReport,Transaction $transaction, $price) {
        $nextMonthId = $loanReport->id + 1;
        // Find next month report
        $loanNext = LoanReport::find($nextMonthId);

        if(isset($loanNext)):
            if($loanNext->totalDept < $price):
                $loanNext->paid = true;
                $loanNext->paid_at = now();
                $loanNext->saveQuietly();

                $price -= $loanNext->totalDept;

                $this->handleLoanReport($loanNext, $transaction, $price);

            elseif ($loanNext->totalDept == $price):
                $loanNext->paid = true;
                $loanNext->paid_at = now();
                $loanNext->saveQuietly();

            else:
                //Update percentage remainder
                if($price > $loanNext->percentDept):
                    $loanNext->percentage_remainder = $loanNext->percentDept;
                    $loanNext->main_remainder = $price - $loanNext->percentDept;

                    $loanNext->saveQuietly();
                elseif ($price == $loanNext->percentDept):
                    $loanNext->percentage_remainder = $loanNext->percentDept;
                    $loanNext->saveQuietly();
                else:
                    $loanNext->percentage_remainder = $loanNext->percentDept - $price;
                    $loanNext->saveQuietly();
                endif;
            endif;
         endif;

        // Update loan make it paid if Loan is fully paid
    }

    public function updateAccounts(Transaction $transaction) {
        $accounts = Account::first();

        $accounts->balance += $transaction->price;

        $accounts->saveQuietly();
    }

    protected function updateRegistry(Transaction $transaction, Loan $loan) {
        $reyester = new Registry();

        $reyester->amount = $transaction->price;
        $reyester->debet = 123;
        $reyester->credit = 124;
        $reyester->customer_id = $loan->customer->id;
        $reyester->product_id = $loan->product->id;
        $reyester->product_name = $loan->product->name;

        $reyester->saveQuietly();
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
