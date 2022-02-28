<?php

namespace App\Helpers;

use App\Models\Loan;

class LoanHelper
{

    public static function findMainDept(Loan $loan) {
        $reports = $loan->loanReports()->active()->get();

        $sum = $reports->sum('mainDept');

        $mainDeptRemainder = $reports->sum('main_remainder');

        if($reports->count() === $loan->month || $reports->count() === $loan->rescheduled_month) {
            return $loan->rescheduled ? $loan->rescheduled_price : $loan->price;
        }

        return round($sum - $mainDeptRemainder, 2);
    }
}
