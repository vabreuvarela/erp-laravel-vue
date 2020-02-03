<?php

namespace App\Policies;

use App\Helpers\AuthorizationHelpers;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can view the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can create models users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can update the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can delete the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can restore the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the models user.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }
}
