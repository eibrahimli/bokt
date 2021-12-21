<?php

namespace App\Observers;

use App\Models\Contract;
use App\Nova\Supplier;

class ContractObserver
{
    /**
     * Handle the Contract "created" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function created(Contract $contract)
    {
        //
       /* $supplier = Supplier::find($contract->supplier_id);

        if($supplier){
            $rest_amount = $supplier->rest_amount;
            $paid_amount = $supplier->paid_amount;

            $rest = 0;
            $paid = 0;

            if(floatval($contract->price) > 0){
                $price = floatval($contract->price);

                if(floatval($contract->advance_price)>0){
                    $advance_price = floatval($contract->advance_price);
                }else{
                    $advance_price = 0;
                }

                $rest = $price-$advance_price;
                $paid = $advance_price;

            }

            $supplier->paid_amount = $paid_amount + $paid;
            $supplier->rest_amount = $rest_amount + $rest;
            $supplier->save();


        }*/

    }

    /**
     * Handle the Contract "updated" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function updated(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "deleted" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function deleted(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "restored" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function restored(Contract $contract)
    {
        //
    }

    /**
     * Handle the Contract "force deleted" event.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function forceDeleted(Contract $contract)
    {
        //
    }
}
