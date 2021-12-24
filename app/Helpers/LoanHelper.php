<?php

namespace App\Helpers;

use App\Models\Loan;
use Mortgage\Facades\Annuity;

class LoanHelper
{
    public static function getCurrentMonthPayment(Loan $loan) {
        dd($loan);
    }
}
