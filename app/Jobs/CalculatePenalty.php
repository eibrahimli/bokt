<?php

namespace App\Jobs;

use App\Helpers\LoanHelper;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Loan;
use App\Models\LoanReport;

class CalculatePenalty implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $loans = $this->getAllLoans();

        foreach ($loans as $loan) {
            $loanReport = $this->getLoanCurrentMonth($loan);

            if($loanReport):
                $mainDept = LoanHelper::findMainDept($loan);

                // Ödəməli olduğu tarix
                $shouldPay = Carbon::parse($loanReport->shouldPay);
                $now = Carbon::now();

                if($shouldPay < $now) {
                    $differenceDays = $shouldPay->diffInDays($now);

                    $penalty = $mainDept * 1 / 100;

                    $totalPenalty = $penalty * $differenceDays;

                    $loanReport->penalty = $totalPenalty;
                    $loanReport->penalty_day = $differenceDays;

                    $loanReport->save();
                }
            endif;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }

    protected function getAllLoans() {
        return Loan::active()->unclosed()->get();
    }

    protected function getLoanCurrentMonth(Loan $loan) {
        return $loan->loanReports()->active()->first();
    }
}
