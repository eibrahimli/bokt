<?php

namespace App\Observers;

use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Work;
use App\Models\WorkInner;
use App\Nova\Registry;

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
        $workInner = WorkInner::where("work_id",$work->id)->get();

        if($work->supplier_id > 0){
            $supplier = Supplier::find($work->supplier_id);
            if($supplier!=null){


                $old_balance = $supplier->rest_amount;
                $new_balance = $old_balance  +  $work->total_price;
                $supplier->rest_amount = 112; //$new_balance;
                $supplier->text = json_encode($workInner);
                $supplier->save();
            }
        }
        //dd($work);
       /*     foreach ($workInner as $inner){
                $registry = new \App\Models\Registry();
                $registry->amount = $inner->total_price;
                $registry->debet = $inner->debet;
                $registry->credit = $inner->credit;
                $registry->reg_type = 'WorkInner';
                $registry->reg_id = $inner->id;
                $registry->product_id = $inner->type;
                $registry->product_name = $inner->name;
                $registry->branch_id = $work->branch_id;
                $registry->account_id = null;
                $registry->customer_id = null;
                $registry->supplier_id = $work->supplier_id;
                $registry->save();
            }*/


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
