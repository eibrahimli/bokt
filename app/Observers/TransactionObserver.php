<?php

namespace App\Observers;

use App\Helpers\LoanHelper;
use App\Models\Account;
use App\Models\Loan;
use App\Models\LoanReport;
use App\Models\Registry;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionObserver
{
    protected $totalPayedPercentagePrice = 0 ,$totalPayedMainPrice = 0;

    public function created(Transaction $transaction)
    {
        $loan = $transaction->loan;
        $loanReport = $transaction->loan->loanReports()->active()->whereNull('deleted_at')->whereNull('paid_at')->first();

        $totalPrice = round(($loanReport->totalDept - $loanReport->percentage_remainder - $loanReport->main_remainder) + $loanReport->penalty, 2);

        if(!$transaction->service_fee):

            //       Əgər kredit ödəyən şəxs tam məbləği ödəyibsə kreditini həmin ay üçün bağla
            if($totalPrice == $transaction->price) {
                $loanReport->paid = true;
                $loanReport->paid_at = now();

                if($loan->rescheduled):
                    $loan->rescheduled_payed_balance += $transaction->price;
                else:
                    $loan->payed_balance += $transaction->price;
                endif;

                // Əgər müştəri əvvəl ödəyibsə tam faizi o zaman tam faizi 0 et
                if($loanReport->percentDept == $loanReport->percentage_remainder):
                    $this->setPayedPercentageAndMainPrice(0,$loanReport->mainDept - $loanReport->main_remainder);
                else:
                    $this->setPayedPercentageAndMainPrice(($loanReport->percentDept - $loanReport->percentage_remainder),($loanReport->mainDept - $loanReport->main_remainder));
                endif;

                $loanReport->saveQuietly();

            }
            // Əgər ödənilən məbləğ ümumi ödəyəcəyi məbləğdən böyükdürsə bura gir
            elseif ($totalPrice < $transaction->price) {
                $loanReport->paid = true;
                $loanReport->paid_at = now();

                // Add transaction price to loan payed balance
                if($loan->rescheduled):
                    $loan->rescheduled_payed_balance += $transaction->price;
                else:

                    $loan->payed_balance += $transaction->price;
                endif;

                // Əgər müştəri əvvəl ödəyibsə tam faizi o zaman tam faizi 0 et
                if($loanReport->percentDept == $loanReport->percentage_remainder):
                    $this->setPayedPercentageAndMainPrice(0,$loanReport->mainDept - $loanReport->main_remainder);
                else:
                    $this->setPayedPercentageAndMainPrice($loanReport->percentDept - $loanReport->percentage_remainder,$loanReport->mainDept - $loanReport->main_remainder);
                endif;

                $loan->saveQuietly();
                $loanReport->saveQuietly();

                $price = $transaction->price - $totalPrice;

                $this->handleLoanReport($loanReport,$transaction, $price);
            }
            // Əgər kredit ödəyicisi az ödəyibsə bu if bloku çalışacaq
            elseif($totalPrice > $transaction->price) {

                $price = $transaction->price - $loanReport->penalty;
                //Update percentage remainder
                if($price > $loanReport->percentDept):
                    $loanReport->percentage_remainder = $loanReport->percentDept;
                    $loanReport->main_remainder = $price - $loanReport->percentDept;

                    $this->setPayedPercentageAndMainPrice($loanReport->percentDept, $price - $loanReport->percentDept);

                    $loanReport->saveQuietly();
                elseif ($price == $loanReport->percentDept):
                    $this->setPayedPercentageAndMainPrice($loanReport->percentDept, 0);
                    $loanReport->percentage_remainder = $loanReport->percentDept;
                    $loanReport->saveQuietly();
                else:
                    $this->setPayedPercentageAndMainPrice($price, 0);
                    $loanReport->percentage_remainder = $price;
                    $loanReport->saveQuietly();
                endif;

                if($loan->rescheduled):
                    $loan->rescheduled_payed_balance += $transaction->price;
                else:
                    $loan->payed_balance += $transaction->price;
                endif;
            }


        endif;

        // Əgər cədvəl yenidən yaradılıb və ya yaradılmayıbsa kredit reportunu yenilə
        if($loan->rescheduled):

            $loan->rescheduled_report = $loan->loanReports;
        else:

            $loan->current_main_price = LoanHelper::findMainDept($loan);
            $loan->credit_report = $loan->loanReports;
        endif;

        // Əgər kreditin ödənməmiş reportu varsa bağla krediti və ödənmiş kimi göstər

        if($loan->loanReports->count() === 0):
            $loan->closed = true;
        endif;

        $loan->saveQuietly();

        // Hesablardan məbləği çıx
        $this->updateAccounts($transaction);

        // Add Data to Reyestr
        $this->updateRegistry($transaction, $loan);

        $transaction->main_price = $this->totalPayedMainPrice;
        $transaction->interested_price = $this->totalPayedPercentagePrice;
        $transaction->shouldPay = $loanReport->shouldPay;
        $transaction->calculated_price = $loanReport->penalty;
        $transaction->penalty_day = $loanReport->penalty_day;
        if(!$transaction->service_fee):
            $transaction->expected_price = $totalPrice;
        endif;
        $transaction->saveQuietly();

    }

    protected function handleLoanReport(LoanReport $loanReport,Transaction $transaction, $price) {
        $nextMonthId = $loanReport->id + 1;
        // Find next month report
        $loanNext = LoanReport::find($nextMonthId);

        if(isset($loanNext)):
            if($loanNext->totalDept + $loanNext->penalty < $price):
                $loanNext->paid = true;
                $loanNext->paid_at = now();
                $loanNext->saveQuietly();

                // Ümumi ödənilmiş əsas və faiz məbləği artır
                $this->setPayedPercentageAndMainPrice($loanNext->percentDept, $loanNext->mainDept);

                $price -= $loanNext->totalDept;

                $this->handleLoanReport($loanNext, $transaction, $price);

            elseif ($loanNext->totalDept + $loanNext->penalty == $price):
                // Ümumi ödənilmiş əsas və faiz məbləği artır
                $this->setPayedPercentageAndMainPrice($loanNext->percentDept, $loanNext->mainDept);

                $loanNext->paid = true;
                $loanNext->paid_at = now();
                $loanNext->saveQuietly();

            else:
                //Update percentage remainder
                if($price > $loanNext->percentDept):
                    $loanNext->percentage_remainder = $loanNext->percentDept;
                    $loanNext->main_remainder = $price - $loanNext->percentDept;

                    // Ümumi ödənilmiş əsas və faiz məbləği artır
                    $this->setPayedPercentageAndMainPrice($loanNext->percentDept, $price - $loanNext->percentDept);

                    $loanNext->saveQuietly();
                elseif ($price == $loanNext->percentDept):
                    $loanNext->percentage_remainder = $loanNext->percentDept;

                    // Ümumi ödənilmiş əsas və faiz məbləği artır
                    $this->setPayedPercentageAndMainPrice($loanNext->percentDept, 0);
                    $loanNext->saveQuietly();
                else:
                    $loanNext->percentage_remainder = $price;
                    // Ümumi ödənilmiş əsas və faiz məbləği artır
                    $this->setPayedPercentageAndMainPrice($price, 0);
                    $loanNext->saveQuietly();
                endif;
            endif;
         endif;

        // Update loan make it paid if Loan is fully paid
    }

    public function updateAccounts(Transaction $transaction) {
        $accounts = Account::first();
        $accounts->balance += $transaction->price;

        $accounts->save();
    }

    protected function updateRegistry(Transaction $transaction, Loan $loan) {
        $reyester = new Registry();

        if($transaction->service_fee):
            $this->createRegisrty($transaction, $loan,127020, 420010,$transaction->price, 'LOAN_SERVICE');;

        else:
            $this->createRegisrty($transaction, $loan,127020, 221100,$this->totalPayedMainPrice, 'LOAN_PAYMENT');
            $this->createRegisrty($transaction, $loan,127020, 420060,$this->totalPayedPercentagePrice, 'LOAN_INTEREST');

        endif;

    }

    public function updated(Transaction $transaction)
    {


    }

    public function deleted(Transaction $transaction)
    {
        //
    }

    public function restored(Transaction $transaction)
    {
        //
    }

    public function forceDeleted(Transaction $transaction)
    {
        //
    }

    public function setPayedPercentageAndMainPrice ($percentage, $main) :void {
        $this->totalPayedPercentagePrice += $percentage;
        $this->totalPayedMainPrice += $main;
    }

    protected function createRegisrty(Transaction $transaction, Loan $loan, $debet , $kredit, $price, $reg_type) {
        $reyester = new Registry();
        $reyester->amount = $price;
        $reyester->debet = $debet; // Kass
        $reyester->credit = $kredit;
        $reyester->reg_type = $reg_type;
        $reyester->reg_id = $transaction->id;
        $reyester->product_id = $loan->id;
        $reyester->product_name = $loan->customer->id. ' '.$loan->customer->name. ' '.$loan->customer->surname;
        $reyester->branch_id = Auth::user()->branch->id;
        $reyester->account_id = 777;// Auth::user()->branch->account->id;
        $reyester->customer_id = $loan->customer->id;
        $reyester->supplier_id = null;

        $reyester->saveQuietly();
    }
}
