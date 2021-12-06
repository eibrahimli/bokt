<?php

namespace Mortgage\Schedules;

use Mortgage\Mortgage;
use Mortgage\Contracts\RepaymentSchedule;

class AnnuitySchedule implements RepaymentSchedule
{
    /**
     * Detailed repayment schedule
     *
     * @var array
     */
    private $repaymentScheduleResult = [];

    /**
     * The amount you need to pay
     * for the current month
     *
     * @var integer
     */
    private $mainDeptByMonth;

    /**
     * How much is left to pay
     * for the entire period
     *
     * @var integer
     */
    private $loanAmount;

    /**
     * How much is left to pay
     * from the current month
     *
     * @var integer
     */
    private $loanAmountInMonth;

    /**
     * main dept by month
     *
     * @var integer
     */
    private $mainDept;

    /**
     * dept by percent
     *
     * @var integer
     */
    private $percentDept;


    private $prevMainDept = [1 => 0];

    /**
     * total percent dept for the entire period
     *
     * @var integer
     */
    private $totalPercentDept;

    /**
     * total dept for the entire period with percent
     *
     * @var integer
     */
    private $totalDept;

    /**
     * negative debt by month
     *
     * @var array
     */
    private $deptValues = [];

    /**
     * To compute and set percent dept
     *
     * @param float $percentageRatio
     * @return object
     */
    private function percentDeptCompute($percentageRatio)
    {
        $this->percentDept = $this->numbRound(($this->loanAmountInMonth * $percentageRatio) / 100);
        $this->totalPercentDept += $this->percentDept;
        return $this;
    }

    /**
     * To compute and set total dept
     *
     * @return object
     */
    private function totalDeptCompute($mortgage)
    {

        $percentRate = (($mortgage->getInterestRate() / 100) / 12);
        $exponentExpression = pow((1 + $percentRate), $mortgage->getLoanTerm());
        $upAnuitetExpression = $percentRate * $exponentExpression;
        $downAnuitetExpression = $exponentExpression - 1;
        $anuitet = $upAnuitetExpression / $downAnuitetExpression;

        $this->totalDept = $this->numbRound($anuitet * $mortgage->getLoanAmount());
        return $this;
    }

    /**
     * main dept updated TO DO
     *
     * @return object
     */
    private function setMainDept($monthIndex)
    {
        if ($monthIndex !== 1) {
            $this->prevMainDept[$monthIndex - 1] = $this->mainDept;
        }

        $this->mainDept = $this->totalDept - $this->percentDept;
        return $this;
    }

    /**
     * Set the initial parameters
     *
     * @param Mortgage $mortgage \Mortgage\Mortgage
     * @return void
     */
    private function baseMount($mortgage)
    {
        $this->mainDept = 0;
        $this->loanAmount = $mortgage->getLoanAmount();
        $this->loanAmountInMonth = $mortgage->getLoanAmount();
        $this->percentDept = 0;
        $this->totalPercentDept = 0;
        $this->totalDept = 0;
        $this->mainDeptByMonth = 0;

        array_push($this->deptValues, $this->numbRound($this->loanAmount));
    }

    /**
     * To compute and set main dept by month
     * and loan amount in month
     *
     * @param integer $monthIndex
     * @param Mortgage $mortgage \Mortgage\Mortgage
     * @return object
     */
    private function loanAmountCompute($monthIndex, Mortgage $mortgage)
    {

        if ($monthIndex !== 1):
            $this->mainDeptByMonth = $this->mainDept + $this->mainDeptByMonth;
        else:
            $this->mainDeptByMonth = $this->mainDept * $monthIndex;
        endif;
        $this->loanAmountInMonth = $this->loanAmount - $this->mainDeptByMonth;
        return $this;
    }

    /**
     * Just round the number
     *
     * @param integer $repNumb
     * @return void
     */
    private function numbRound($repNumb)
    {
        return round($repNumb * 100) / 100;
    }

    /**
     * Сreate a new instance of the schedule
     *
     * @param integer $monthIndex
     * @return object
     */
    private function createSchedule($monthIndex)
    {
        // dd($this->percentDept);
        return new \Mortgage\Support\RepaymentReport(
            $monthIndex,
            $this->numbRound($this->totalDept),
            $this->percentDept,
            $this->numbRound($this->mainDept),
            $this->numbRound($this->loanAmountInMonth)
        );
    }

    /**
     * Calculate the full mortgage schedule
     *
     * @param Mortgage $mortgage
     * @return array
     */
    public function toCompute(Mortgage $mortgage)
    {

        $this->baseMount($mortgage);

        for ($monthIndex = 1; $monthIndex <= $mortgage->getLoanTerm(); $monthIndex++) {

            $this->totalDeptCompute($mortgage)
                ->percentDeptCompute($mortgage->getPercentageRatio())
                ->setMainDept($monthIndex)
                ->loanAmountCompute($monthIndex, $mortgage);

            array_push($this->repaymentScheduleResult, $this->createSchedule($monthIndex));
        }

        return [
            'repaymentScheduleResult' => $this->repaymentScheduleResult,
            'totalPercentDept' => $this->numbRound($this->totalPercentDept),
            'deptValues' => $this->deptValues,
        ];
    }
}
