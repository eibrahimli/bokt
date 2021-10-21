<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerObserver
{

    public function created(Customer $customer)
    {
        $customer->user_id = Auth::id();

        $customer->unsetEventDispatcher();

        $customer->save();
    }


    public function updated(Customer $customer)
    {
        $customer->user_id = Auth::id();

        $customer->unsetEventDispatcher();

        $customer->save();
    }

    public function deleted(Customer $customer)
    {
        //
    }

    public function restored(Customer $customer)
    {
        //
    }

    public function forceDeleted(Customer $customer)
    {
        //
    }
}
