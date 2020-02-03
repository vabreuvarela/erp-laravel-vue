<?php

namespace App\Policies;

use App\Helpers\AuthorizationHelpers;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehousePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models warehouses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can view the models warehouse.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return mixed
     */
    public function view(User $user, Warehouse $warehouse)
    {
        return AuthorizationHelpers::isAuthorized($warehouse);
    }

    /**
     * Determine whether the user can create models warehouses.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can update the models warehouse.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return mixed
     */
    public function update(User $user, Warehouse $warehouse)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can delete the models warehouse.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $modelsWarehouse
     * @return mixed
     */
    public function delete(User $user, Warehouse $warehouse)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can restore the models warehouse.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return mixed
     */
    public function restore(User $user, Warehouse $warehouse)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the models warehouse.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Warehouse  $warehouse
     * @return mixed
     */
    public function forceDelete(User $user, Warehouse $warehouse)
    {
        return AuthorizationHelpers::isAdmin();
    }
}
