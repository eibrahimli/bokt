<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        return true;
    }

    public function update(User $user, Loan $loan)
    {
        return false;
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
}
