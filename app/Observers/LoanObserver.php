<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Loan;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoanObserver
{

    public function created(Loan $loan)
    {
        $loan->user_id = Auth::id();
        $loan->percentage = $loan->product->percentage;

        $report = (new \App\Helpers\CreditHelper($loan->month,$loan->price,$loan->percentage))->getFormatedData();

        $loan->loanReports()->createMany($report);
        $loan->whole_payable_balance = array_sum(array_column($report, 'totalDept'));

        // Hesablardan məbləği çıx
        $accounts = Account::first();
        $accounts->balance = $accounts->balance - $loan->price;

        $accounts->saveQuietly();

        $loan->saveQuietly();

    }
//    public function creating(Loan $loan)
//    {
//        $loan->unsetEventDispatcher();
//        $loan->percentage = $loan->product->percentage;
//    }

    public function updated(Loan $loan)
    {
        $loan->user_id = Auth::id();

        $loan->loanReports()->delete();

        $report = (new \App\Helpers\CreditHelper($loan->month,$loan->price,$loan->percentage))->getFormatedData();

        $loan->loanReports()->createMany($report);
        $loan->whole_payable_balance = array_sum(array_column($report, 'totalDept'));

        $loan->saveQuietly();

    }

    public function deleted(Loan $loan)
    {
        $loan->loanReports()->delete();
        $loan->transactions()->delete();
    }

    public function restored(Loan $loan)
    {
        //
    }

    public function forceDeleted(Loan $loan)
    {
        //
    }
}
