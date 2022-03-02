<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\IncomeOperation;
use App\Models\Registry;

class IncomeOperationObserver
{
    /**
     * Handle the IncomeOperation "created" event.
     *
     * @param  \App\Models\IncomeOperation  $incomeOperation
     * @return void
     */
    public function created(IncomeOperation $incomeOperation)
    {
        // FROM ACCOUNT
        $account_id = $incomeOperation->account_id;
        $account = Account::where("id",$account_id)->first();
        $total_price = $incomeOperation->price;


        $registry = new Registry();
        $registry->amount = $incomeOperation->price;
        $registry->debet = $incomeOperation->debet;
        $registry->credit = $incomeOperation->credit;
        $registry->reg_type = 'Income';
        $registry->reg_id = $incomeOperation->id;
        $registry->product_id = 0;
        $registry->product_name = $incomeOperation->purpose_payment;
        $registry->branch_id = $incomeOperation->branch_id;
        $registry->account_id = $incomeOperation->account_id;
        $registry->customer_id = $incomeOperation->customer_id;
        $registry->supplier_id = $incomeOperation->supplier_id;
        $registry->save();


        if($account!=null){
            $old_balance = floatval($account->balance);
            if(($old_balance - $total_price)>0){
                $new_balance = $old_balance-$total_price;
                $account->balance = $new_balance;
                $account->saveQuietly();
            }
        }

        // TO ACCOUNT
        $account_to_id = $incomeOperation->account_to;
        $account = Account::where("id",$account_to_id)->first();
        $total_price = $incomeOperation->price;
        if($account!=null){
            $old_balance = floatval($account->balance);
            $new_balance = $old_balance+$total_price;
            $account->balance = $new_balance;
            $account->saveQuietly();
        }

        //

    }

    /**
     * Handle the IncomeOperation "updated" event.
     *
     * @param  \App\Models\IncomeOperation  $incomeOperation
     * @return void
     */
    public function updated(IncomeOperation $incomeOperation)
    {
        //
    }

    /**
     * Handle the IncomeOperation "deleted" event.
     *
     * @param  \App\Models\IncomeOperation  $incomeOperation
     * @return void
     */
    public function deleted(IncomeOperation $incomeOperation)
    {
        //
    }

    /**
     * Handle the IncomeOperation "restored" event.
     *
     * @param  \App\Models\IncomeOperation  $incomeOperation
     * @return void
     */
    public function restored(IncomeOperation $incomeOperation)
    {
        //
    }

    /**
     * Handle the IncomeOperation "force deleted" event.
     *
     * @param  \App\Models\IncomeOperation  $incomeOperation
     * @return void
     */
    public function forceDeleted(IncomeOperation $incomeOperation)
    {
        //
    }
}
