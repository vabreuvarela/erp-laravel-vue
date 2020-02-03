<?php

namespace App\Policies;

use App\Helpers\AuthorizationHelpers;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models products.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can view the models product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function view(User $user, Product $product)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can create models products.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can update the models product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update(User $user, Product $product)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can delete the models product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function delete(User $user, Product $product)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can restore the models product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        return AuthorizationHelpers::isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the models product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        return AuthorizationHelpers::isAdmin();
    }
}
