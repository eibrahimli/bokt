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
     /*   $supplier = Supplier::find($contract->supplier_id);

        if($supplier){
            $rest_amount = $supplier->rest_amount;
            $price = 0;
            if(floatval($contract->price) > 0){
                $price = floatval($contract->price);

            }
            $supplier->rest_amount = $rest_amount + $price;
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
