<?php

namespace App\Helpers;

use Carbon\Carbon;
use Mortgage\Facades\Annuity;

class CreditHelper {
    protected $loanTerm,$loanAmount,$serviceFee,$loanPercentage, $nextMonthPayment;
    private $originalTotalDept;

    /**
     * @param $loanTerm
     * @param $loanAmount
     * @param $loanPercentage
     */
    function __construct($loanTerm, $loanAmount, $loanPercentage, $serviceFee = 1) {
        $this->loanPercentage = $loanPercentage;
        $this->loanTerm = $loanTerm;
        $this->loanAmount = $loanAmount;
        $this->serviceFee = $serviceFee;
    }
    // Get formatted payments report in month
    public function getFormatedData(): array
    {
        // Change the mortgage config file values
        config(['mortgage.loanTerm' => $this->loanTerm,'mortgage.loanAmount' => $this->loanAmount, 'mortgage.interestRate' => $this->loanPercentage]);

        // Grab the monthly payment report
        $report = Annuity::showRepaymentSchedule()->toArray();

        $this->originalTotalDept = $report[0]['totalDept'];

        // Fix report bug
        foreach ($report as $index => $rep) {
            $this->findPaymentMonth();

            if($index == 0):
                $report[0]['service_fee'] = round($this->loanAmount * $this->serviceFee / 100, 2);
            endif;

            $report[$index]['termInMonth'] = $report[$index]['termInMonth'].' - '. $this->nextMonthPayment->toDateString();
            $report[$index]['shouldPay'] = $this->nextMonthPayment->toDateString();

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

    private function findPaymentMonth()  {
        $currentTime = $this->nextMonthPayment ?: Carbon::now();
        $this->nextMonthPayment = $currentTime->addMonth();
        if($this->nextMonthPayment->dayOfWeek == Carbon::SATURDAY):
            $this->nextMonthPayment = $this->nextMonthPayment->addDays(2);
        elseif($this->nextMonthPayment->dayOfWeek == Carbon::SUNDAY):
            $this->nextMonthPayment = $this->nextMonthPayment->addDay();
        endif;
    }

}
