<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\ExpenseOperation;
use App\Models\Registry;

class ExpenseOperationObserver
{
    /**
     * Handle the ExpenseOperation "created" event.
     *
     * @param  \App\Models\ExpenseOperation  $expenseOperation
     * @return void
     */
    public function created(ExpenseOperation $expenseOperation)
    {
        //
        $account_id = $expenseOperation->account_id;
        $account = Account::find($account_id);
        $total_price = $expenseOperation->total_price;
        if($account!=null){
            $old_balance = floatval($account->balance);
            if(($old_balance - $total_price)>0){
                $new_balance = $old_balance-$total_price;
                $account->balance = $new_balance;
                $account->save();
            }
        }


        $registry = new Registry();
        $registry->amount = $expenseOperation->total_price;
        $registry->debet = $expenseOperation->debet;
        $registry->credit = $expenseOperation->credit;
        $registry->reg_type = 'Expense';
        $registry->reg_id = $expenseOperation->id;
        $registry->product_id = 0;
        $registry->product_name = $expenseOperation->purpose_payment;
        $registry->branch_id = $expenseOperation->branch_id;
        $registry->account_id = $expenseOperation->account_id;
        $registry->customer_id = $expenseOperation->customer_id;
        $registry->supplier_id = $expenseOperation->supplier_id;
        $registry->save();
    }

    /**
     * Handle the ExpenseOperation "updated" event.
     *
     * @param  \App\Models\ExpenseOperation  $expenseOperation
     * @return void
     */
    public function updated(ExpenseOperation $expenseOperation)
    {
        //
    }

    /**
     * Handle the ExpenseOperation "deleted" event.
     *
     * @param  \App\Models\ExpenseOperation  $expenseOperation
     * @return void
     */
    public function deleted(ExpenseOperation $expenseOperation)
    {
        //
    }

    /**
     * Handle the ExpenseOperation "restored" event.
     *
     * @param  \App\Models\ExpenseOperation  $expenseOperation
     * @return void
     */
    public function restored(ExpenseOperation $expenseOperation)
    {
        //
    }

    /**
     * Handle the ExpenseOperation "force deleted" event.
     *
     * @param  \App\Models\ExpenseOperation  $expenseOperation
     * @return void
     */
    public function forceDeleted(ExpenseOperation $expenseOperation)
    {
        //
    }
}
