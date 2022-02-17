<?php

namespace App\Observers;

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
        //
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
