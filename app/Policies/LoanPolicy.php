<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

class LoanPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Loan $loan)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Loan $loan)
    {
        return $user->role === 'cashier' ? false : true;
    }

    public function delete(User $user, Loan $loan)
    {
        //
    }


    public function restore(User $user, Loan $loan)
    {
        //
    }

    public function forceDelete(User $user, Loan $loan)
    {
        //
    }

    public function addTransaction (User $user, Loan $loan): bool
    {
        return $loan->loanReports()->active()->count() > 0 && $loan->serviceFeePayed && $loan->loanPenalties()->unPaid()->count() === 0;
    }

}
