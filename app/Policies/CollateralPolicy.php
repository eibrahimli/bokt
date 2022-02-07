<?php

namespace App\Policies;

use App\Models\Collateral;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollateralPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, Collateral $collateral)
    {
        return true;
    }

    public function create(User $user)
    {
        return false;
    }

    public function update(User $user, Collateral $collateral)
    {
        return false;
    }


    public function delete(User $user, Collateral $collateral)
    {
        return false;
    }


    public function restore(User $user, Collateral $collateral)
    {
        //
    }

    public function forceDelete(User $user, Collateral $collateral)
    {
        //
    }
}
