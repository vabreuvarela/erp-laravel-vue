<?php

namespace App\Helpers;

use App\Models\Warehouse;

class AuthorizationHelpers
{
    public function isAuthorized(Warehouse $warehouse)
    {
        return self::isAdmin() || self::isWarehouseUser($warehouse);
    }

    public function isWarehouseUser(Warehouse $warehouse)
    {
        return Auth::check() && $warehouse->users()->where('id', Auth::user()->id)->exists();
    }

    public function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}
