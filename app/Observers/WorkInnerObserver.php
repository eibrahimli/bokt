<?php

namespace App\Observers;

use App\Models\Work;
use App\Models\WorkInner;
use App\Models\Registry;

class WorkInnerObserver
{
    /**
     * Handle the WorkInner "created" event.
     *
     * @param  \App\Models\WorkInner  $workInner
     * @return void
     */
    public function created(WorkInner $workInner)
    {
        //
        $registry = new Registry();
        $registry->amount = $workInner->total_price;
        $registry->debet = $workInner->debet;
        $registry->credit = $workInner->credit;
        $registry->reg_type = 'WorkInner';
        $registry->reg_id = $workInner->id;
        $registry->product_id = $workInner->type;
        $registry->product_name = $workInner->name;
        $registry->branch_id = $workInner->work->branch_id;
        $registry->account_id = null;
        $registry->customer_id = null;
        $registry->supplier_id = $workInner->work->supplier_id;
        $registry->save();
    }

    /**
     * Handle the WorkInner "updated" event.
     *
     * @param  \App\Models\WorkInner  $workInner
     * @return void
     */
    public function updated(WorkInner $workInner)
    {
        //
    }

    /**
     * Handle the WorkInner "deleted" event.
     *
     * @param  \App\Models\WorkInner  $workInner
     * @return void
     */
    public function deleted(WorkInner $workInner)
    {
        //
    }

    /**
     * Handle the WorkInner "restored" event.
     *
     * @param  \App\Models\WorkInner  $workInner
     * @return void
     */
    public function restored(WorkInner $workInner)
    {
        //
    }

    /**
     * Handle the WorkInner "force deleted" event.
     *
     * @param  \App\Models\WorkInner  $workInner
     * @return void
     */
    public function forceDeleted(WorkInner $workInner)
    {
        //
    }
}
