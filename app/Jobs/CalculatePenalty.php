<?php

namespace App\Jobs;

use App\Helpers\LoanHelper;
use App\Helpers\PenaltyHelper;
use App\Models\LoanPenalty;
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
        $now = Carbon::now()->addDays(87);

        foreach ($loans as $loan) {
            $loanReports = $loan->loanReports()->active()->get();

            $loansHavePenalty = collect($loanReports)->map(function ($report) use ($now) {
                $shouldPay = Carbon::parse($report->shouldPay);
                if ($shouldPay < $now && !$now->isWeekend()) {
                    return $report;
                }
            })->filter();

            if ($loansHavePenalty->count() > 0):
                $mainDept = PenaltyHelper::findPenaltyMainDept($loansHavePenalty);
                $firstReport = $loansHavePenalty->first()->toArray();

                $firstShouldPayDate = Carbon::parse($firstReport['shouldPay']);
                $differenceDays = $firstShouldPayDate->diffInDaysFiltered(function(Carbon $date) {
                    return !$date->isWeekend();
                },$now);

                $penalty = $mainDept * 1 / 100;

                $totalPenalty = $penalty * $differenceDays;

                $penalty = LoanPenalty::where('loan_id', $firstReport['loan_id'])->first();

                if ($penalty):
                    $penalty->day = $differenceDays;
                    $penalty->price = $totalPenalty;

                    $penalty->save();
                else:
                    $penalty = LoanPenalty::create([
                        'loan_id' => $firstReport['loan_id'],
                        'price' => $totalPenalty,
                        'day' => $differenceDays
                    ]);
                endif;

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

    protected function getLoanReports(Loan $loan) {
        return $loan->loanReports()->active()->get();
    }
}
