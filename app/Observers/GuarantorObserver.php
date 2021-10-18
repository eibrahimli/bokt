<?php

namespace App\Observers;

use App\Models\Guarantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GuarantorObserver
{
    public function updating(Guarantor $guarantor)
    {
        Log::debug('test', $guarantor->toArray());
    }

    public function created(Guarantor $guarantor)
    {
        Log::info($guarantor);
    }


    public function updated(Guarantor $guarantor)
    {
        Log::info($guarantor);
    }

    public function deleted(Guarantor $guarantor)
    {
        //
    }


    public function restored(Guarantor $guarantor)
    {
        //
    }


    public function forceDeleted(Guarantor $guarantor)
    {
        //
    }
}
