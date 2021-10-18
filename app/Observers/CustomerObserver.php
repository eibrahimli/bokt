<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Facades\Log;

class CustomerObserver
{

    public function created(Customer $customer)
    {
        Log::info($customer);
    }


    public function updated(Customer $customer)
    {
        Log::info($customer);
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
