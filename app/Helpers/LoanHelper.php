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
    public static function findPercentDept(Loan $loan): float
    {
        $reports = $loan->loanReports()->active()->get();

        $sum = $reports->sum('percentDept');

        $percentageRemainder = $reports->sum('percentage_remainder');

        return round($sum - $percentageRemainder, 2);
    }

    public static function findPayedMainAndPercent(Loan $loan, $type = 'main')
    {
        $transactions = $loan->transactions;

        if($transactions):
            $sum = 0;

            switch ($type) {
                case 'main';
                    $sum = $transactions->sum('main_price');
                break;

                case 'interest':
                    $sum = $transactions->sum('interested_price');
                break;

                case 'penalty':
                    $sum = $transactions->sum('calculated_price');
                break;
            }
            return round($sum, '2');
        else:

            return 0;
        endif;

    }
}
