<?php

namespace App\Helpers;

use App\Models\LoanReport;
use Carbon\Carbon;

class TransactionHelper
{
    public static function calculatePenalty(LoanReport $loanReport) {
        $shouldPay = Carbon::parse($loanReport->shouldPay);
        if(Carbon::now() > $shouldPay):
            return $shouldPay->diff(Carbon::now())->days;
        endif;

        return 0;
    }
}
