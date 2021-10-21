<?php

namespace App\Observers;

use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanObserver
{

    public function created(Loan $loan)
    {

        $loan->user_id = Auth::id();
        $loan->unsetEventDispatcher();

        $loan->save();
    }

    public function updated(Loan $loan)
    {
        $loan->user_id = Auth::id();
        $loan->unsetEventDispatcher();

        $loan->save();
    }


    public function deleted(Loan $loan)
    {
        //
    }

    public function restored(Loan $loan)
    {
        //
    }

    public function forceDeleted(Loan $loan)
    {
        //
    }
}
