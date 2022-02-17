<?php

namespace App\Helpers;

use App\Models\Loan;
use Mortgage\Facades\Annuity;

class LoanHelper
{
    public static function getCurrentMonthPayment(Loan $loan) {
        dd($loan);
    }

    public static function findMainDept(Loan $loan) {
        $reports = $loan->loanReports()->active()->get();

        $sum = $reports->sum('mainDept');

        $mainDeptRemainder = $reports->sum('main_remainder');

        if($reports->count() === $loan->month || $reports->count() === $loan->rescheduled_month) {
            return $loan->rescheduled ? $loan->rescheduled_price : $loan->price;
        }

        return $sum - $mainDeptRemainder;
    }
}
