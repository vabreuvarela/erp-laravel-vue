<?php

namespace App\Helpers;

use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;

class AuthorizationHelpers
{
    public static function isAuthorized(Warehouse $warehouse)
    {
        return self::isAdmin() || self::isWarehouseUser($warehouse);
    }

    public static function isWarehouseUser(Warehouse $warehouse)
    {
        return Auth::check() && $warehouse->users()->where('id', Auth::user()->id)->exists();
    }

    public static function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }
}
