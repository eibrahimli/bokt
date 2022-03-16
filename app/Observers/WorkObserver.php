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
        $workInner = WorkInner::where("work_id",$work->id)->get();

        if($work->supplier_id > 0){
            $supplier = Supplier::find($work->supplier_id);
            if($supplier!=null){
                $total_price = 0;
                $total_result = $work->total_result;
                $total_array = json_decode($total_result,TRUE);
                if(isset($total_array["total"]) and $total_array["total"]>0){
                    $total_price = floatval($total_array["total"]);
                }

                $old_balance = $supplier->rest_amount;
                $new_balance = $old_balance  + $total_price;
                $supplier->rest_amount = $new_balance;
                $supplier->text = json_encode($workInner);
                $supplier->save();
            }
        }


    }

    /**
     * Handle the Work "updated" event.
     *
     * @param  \App\Models\Work  $work
     * @return void
     */
    public function updating(Work $work)
    {

        //ok
        if ($work->total_result != $work->getOriginal('total_result')) {
            if($work->supplier_id > 0) {
                $supplier = Supplier::find($work->supplier_id);
                if ($supplier != null) {
                    $old_total_price = 0;
                    $old_total_result = $work->getOriginal('total_result');
                    $old_total_array = json_decode($old_total_result, TRUE);
                    if (isset($old_total_array["total"]) and $old_total_array["total"] > 0) {
                        $old_total_price = floatval($old_total_array["total"]);
                    }

                    $old_balance = $supplier->rest_amount;
                    $old_balance = $old_balance - $old_total_price;

                    $total_price = 0;
                    $total_result = $work->total_result;
                    $total_array = json_decode($total_result, TRUE);
                    if (isset($total_array["total"]) and $total_array["total"] > 0) {
                        $total_price = floatval($total_array["total"]);
                    }

                    $new_balance = $old_balance + $total_price;
                    $supplier->rest_amount = $new_balance;
                    $supplier->save();
                }
            }
        }

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
        $work->workInner()->delete();

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
