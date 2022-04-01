<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Transaction $transaction)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Transaction $transaction)
    {
        return false;
    }

    public function delete(User $user, Transaction $transaction)
    {
        return true;
    }


    public function restore(User $user, Transaction $transaction)
    {
        //
    }

    public function forceDelete(User $user, Transaction $transaction)
    {
        //
    }
}
