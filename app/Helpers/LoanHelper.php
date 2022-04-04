<?php

namespace App\Helpers;

use App\Models\Loan;
use App\Models\Transaction;

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

    public static function decreaseLoanPayedBalance(Loan $loan, Transaction $transaction) {
        if($loan->rescheduled):
            $loan->rescheduled_payed_balance -= $transaction->price;
        else:
        
            $loan->payed_balance -= $transaction->price;
        endif; 

        return $loan;
    }

    public static function findFifd(Loan $loan) {
        $amount = $loan->price;
        $annuitet_percentage = $loan->percentage;
        $loan_period = $loan->month;
        $comission = (float) $loan->loanReports->first()->service_fee;
        $grace_period = 0;

        $flow = [];
        $gracePeriodAmount = 0;

        $new_amount = static::calcPmt($amount, $annuitet_percentage, $loan_period);
        $monthly_annuitet = round($new_amount, 2);
        $totalAmount = round(($new_amount * $loan_period), 2);
        $totalInterest = round(($totalAmount - $amount), 2);
        $investment = (float) ($amount - $comission);

        for ($n = 1; $n <= ($loan_period - $grace_period); $n++) {
            array_push($flow,$monthly_annuitet);
        }

        $fifd = round((static::whatIsFifd($investment, $flow) * 12),1);

        return $fifd;

    }

    public static function whatIsFifd($investment, $flow) {
        for ($n = 0; $n < 100; $n += 0.0001) {
            $pv = 0;
            for ($i = 0; $i < count($flow); $i++) {
                $pv = $pv + $flow[$i] / pow(1 + ($n / 100), $i + 1);
            }
    
            if ($pv <= $investment) {
                return $n;
            }
        }
    }

    public static function calcPmt($amount, $annuitet_percentage, $loan_period) {
        $int = $annuitet_percentage / 1200;
        $int1 = 1 + $int;
        $r1 = pow($int1, $loan_period);

        $r = $amount * ($int * $r1) / ($r1 - 1);

        return is_finite($r) ? $r : 0;
    }


}
