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
        $loan->branch_id = Auth::user()->branch->id;

        $report = (new \App\Helpers\CreditHelper($loan->month,$loan->price,$loan->percentage,$loan->product->service_fee))->getFormatedData();

        $loan->loanReports()->createMany($report);

        $loan->credit_report = $loan->loanReports;

        $loan->whole_payable_balance = collect($report)->sum('totalDept') + $report[0]['service_fee'];

        // Hesablardan məbləği çıx
        $accounts = Account::first();
        $accounts->balance = $accounts->balance - $loan->price;

        $accounts->saveQuietly();

        $loan->saveQuietly();

    }

    public function updated(Loan $loan)
    {
        if($loan->transactions()->count() == 0):
        $loan->loanReports()->delete();

        $report = (new \App\Helpers\CreditHelper($loan->month,$loan->price,$loan->percentage))->getFormatedData();

        $loan->loanReports()->createMany($report);
        $loan->credit_report = $loan->loanReports;

        $loan->whole_payable_balance = collect($report)->sum('totalDept') + $report[0]['service_fee'];

        $loan->saveQuietly();

        endif;

        $loan->credit_report = $loan->loanReports;

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
