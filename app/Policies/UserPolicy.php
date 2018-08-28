<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function list(User $user)
    {
        return $user->can('list_users',User::class);
    }

    public function view(User $currentUser, User $account)
    {
        return ($currentUser->can('view_users')) || $currentUser->id == $account->id;
    }

    public function create(User $currentUser)
    {
        return $currentUser->can('create_users');
    }

    public function update(User $currentUser, User $account)
    {
        return ($currentUser->can('update_users')) || $currentUser->id == $account->id;
    }

    public function delete(User $currentUser, User $account)
    {
        return ($currentUser->can('delete_users') && $account->id != 1);
    }
}
