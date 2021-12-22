<?php

namespace App\Observers;

use App\Models\Contract;
use App\Models\Work;

class WorkObserver
{
    /**
     * Handle the Work "created" event.
     *
     * @param  \App\Models\Work  $work
     * @return void
     */
    public function created(Work $work)
    {
        //
        $branch_id = 0;
        $supplier_id = 0;
        if($work->contract_id > 0){
            $contract = Contract::find($work->contract_id);
            if($contract!=null){
                $branch_id = $contract->branch_id;
                $supplier_id = $contract->supplier_id;
            }
        }
        $work->branch_id = $branch_id;
        $work->supplier_id = $supplier_id;
    }

    /**
     * Handle the Work "updated" event.
     *
     * @param  \App\Models\Work  $work
     * @return void
     */
    public function updated(Work $work)
    {
        //
    }

    /**
     * Handle the Work "deleted" event.
     *
     * @param  \App\Models\Work  $work
     * @return void
     */
    public function deleted(Work $work)
    {
        //
    }

    /**
     * Handle the Work "restored" event.
     *
     * @param  \App\Models\Work  $work
     * @return void
     */
    public function restored(Work $work)
    {
        //
    }

    /**
     * Handle the Work "force deleted" event.
     *
     * @param  \App\Models\Work  $work
     * @return void
     */
    public function forceDeleted(Work $work)
    {
        //
    }
}
