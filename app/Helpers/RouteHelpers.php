<?php

namespace App\Helpers;

use Route;

class RouteHelpers
{
    static function resource ($uri, $slug, $controller) 
    {
        return [
            Route::get($uri, "$controller@index"),
            Route::get("$uri/{{$slug}}", "$controller@show"),
            Route::post($uri, "$controller@store"),
            Route::put("$uri/{{$slug}}", "$controller@update"),
            Route::delete("$uri/{{$slug}}", "$controller@destroy"),
            Route::post("$uri/{{$slug}}/restore", "$controller@restore"),
        ];
    }
}
