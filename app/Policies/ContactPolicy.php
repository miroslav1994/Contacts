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
    public function before(User $user)
    {
        dd('yyy');
        if ($user->role->name == 'admin') {
            return true;
        }
    }
}
