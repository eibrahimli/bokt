<?php

namespace App\Helpers;

use Mortgage\Facades\Annuity;

class CreditHelper {
    protected $loanTerm,$loanAmount,$loanPercentage;
    /**
     * @param $loanTerm
     * @param $loanAmount
     * @param $loanPercentage
     */
    function __construct($loanTerm, $loanAmount, $loanPercentage) {
        $this->loanPercentage = $loanPercentage;
        $this->loanTerm = $loanTerm;
        $this->loanAmount = $loanAmount;
    }
    // Get formatted payments report in month
    public function getFormatedData() {
        // Change the mortgage config file values
        config(['mortgage.loanTerm' => $this->loanTerm,'mortgage.loanAmount' => $this->loanAmount, 'mortgage.interestRate' => $this->loanPercentage]);

        // Grab the monthly payment report
        $report = Annuity::showRepaymentSchedule()->toArray();

        // Fix report bug
        foreach ($report as $index => $rep) {

            if($index === count($report) - 1 && $rep['indebtedness'] < 0) {

                $report[$index-1]['indebtedness'] = $rep['mainDept'];
                $report[$index]['indebtedness'] = 0.00;
            } elseif($index === count($report) - 1 && $rep['indebtedness'] > 0 && $rep['indebtedness'] < 1) {
                $report[$index-1]['indebtedness'] = $report[$index]['mainDept'];
                $report[$index]['indebtedness'] = 0.00;
            }
        }

        return $report;
    }
}
