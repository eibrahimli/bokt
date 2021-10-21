<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{

    public function created(Transaction $transaction)
    {
        $this->setSomeValues($transaction);
    }

    public function updated(Transaction $transaction)
    {
        $this->setSomeValues($transaction);

    }

    public function deleted(Transaction $transaction)
    {
        //
    }

    public function restored(Transaction $transaction)
    {
        //
    }

    public function forceDeleted(Transaction $transaction)
    {
        //
    }

    public function setSomeValues (Transaction $transaction) {
        $price = $transaction->price;

        $transaction->main_price = $price;
        $transaction->interested_price = $price;
        $transaction->calculated_price = $price;
//        dd($transaction->id);
        $transaction->unsetEventDispatcher();
        $transaction->save();

    }
}
