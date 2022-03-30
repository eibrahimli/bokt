<?php

namespace App\Helpers;

class PenaltyHelper
{
    public static function findPenaltyMainDept($reports) {
        return (float) $reports->sum('mainDept') - $reports->sum('main_remainder');
    }
}
