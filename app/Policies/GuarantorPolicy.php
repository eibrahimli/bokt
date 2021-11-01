<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Guarantor;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuarantorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, Guarantor $guarantor)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Guarantor $guarantor)
    {
        return true;
    }


    public function delete(User $user, Guarantor $guarantor)
    {
        return true;
    }


    public function restore(User $user, Guarantor $guarantor)
    {
        //
    }

    public function forceDelete(User $user, Guarantor $guarantor)
    {
        //
    }
}
