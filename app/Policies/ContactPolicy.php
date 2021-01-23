<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactPolicy
{
    use HandlesAuthorization;


    /**
     * @param User $user
     * @return bool
     */
    public function checkIsAdmin(User $user)
    {
        if ($user->role->name == 'admin') {
            return true;
        }

        return false;
    }
}
