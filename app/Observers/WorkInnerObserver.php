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
        $registry->amount = $workInner->price;
        $registry->debet = $workInner->debet;
        $registry->credit = $workInner->credit;
        $registry->reg_type = 'INVOICE';
        $registry->reg_id = $workInner->id;
        $registry->product_id = $workInner->type;
        $registry->product_name = $workInner->name;
        $registry->branch_id = $workInner->work->branch_id;
        $registry->account_id = null;
        $registry->customer_id = null;
        $registry->supplier_id = $workInner->work->supplier_id;
        $registry->save();


        if($workInner->edv>0){
            $price =$workInner->total_price - $workInner->price;
            if($price>0){
                $debet_edv = 260100;
                $credit_edv = 224020;
                $registry = new Registry();
                $registry->amount = $price;
                $registry->debet = $debet_edv;
                $registry->credit = $credit_edv;
                $registry->reg_type = 'INVOICE_EDV';
                $registry->reg_id = $workInner->id;
                $registry->product_id = $workInner->type;
                $registry->product_name = $workInner->name;
                $registry->branch_id = $workInner->work->branch_id;
                $registry->account_id = null;
                $registry->customer_id = null;
                $registry->supplier_id = $workInner->work->supplier_id;
                $registry->save();
            }

        }
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

        $registry = Registry::where("reg_type",'INVOICE')->where("reg_id",$workInner->id)->first();
        if($registry!=null){
            $registry->amount = $workInner->total_price;
            $registry->debet = $workInner->debet;
            $registry->credit = $workInner->credit;
            $registry->product_id = $workInner->type;
            $registry->product_name = $workInner->name;
            $registry->branch_id = $workInner->work->branch_id;
            $registry->account_id = null;
            $registry->customer_id = null;
            $registry->supplier_id = $workInner->work->supplier_id;
            $registry->reg_type = 'Work';
            $registry->reg_id = $workInner->id;
            $registry->save();
        }


        if($workInner->edv>0){
            $price =$workInner->total_price - $workInner->price;
            if($price>0){
                $debet_edv = 260100;
                $credit_edv = 224020;
                $registry = Registry::where("reg_type",'INVOICE_EDV')->where("reg_id",$workInner->id)->first();
                $registry->amount = $price;
                $registry->debet = $debet_edv;
                $registry->credit = $credit_edv;
                $registry->reg_type = 'INVOICE_EDV';
                $registry->reg_id = $workInner->id;
                $registry->product_id = $workInner->type;
                $registry->product_name = $workInner->name;
                $registry->branch_id = $workInner->work->branch_id;
                $registry->account_id = null;
                $registry->customer_id = null;
                $registry->supplier_id = $workInner->work->supplier_id;
                $registry->save();
            }

        }

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
        $reg_id = $workInner->id;
        $regs = Registry::where("reg_type",'INVOICE')->where("reg_id",$reg_id)->first();
        $regs->delete();
        $regs2 = Registry::where("reg_type",'INVOICE_EDV')->where("reg_id",$reg_id)->get();
        $regs2->delete();
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
