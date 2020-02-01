<?php

namespace App\Helpers;

use Route;
use Illuminate\Support\Str;

class RouteHelpers
{
    static function getAction ($resource, $method) 
    {
        return Str::title($resource) . "Controller@" . $method;
    }

    static function resource ($model) 
    {
        return [
            Route::get($model, self::getAction($model, "index")),
            Route::get("$model/{{$model}}", self::getAction($model, "show")),
            Route::post($model, self::getAction($model, "store")),
            Route::put("$model/{{$model}}", self::getAction($model, "update")),
            Route::delete("$model/{{$model}}", self::getAction($model, "destroy")),
            Route::post("$model/{{$model}}/restore", self::getAction($model, "restore")),
        ];
    }

    static function resourceWithRelationships ($model, $relationships) 
    {
        $routes = [];

        foreach ($relationships as $relationship) {
            $routes[] = Route::post("$model/{{$model}}/$relationship", self::getAction($model, "attach" . Str::title($relationship)));
            $routes[] = Route::delete("$model/{{$model}}/$relationship/{{$relationship}}", self::getAction($model, "detach" . Str::title($relationship)));
        }

        return [
            ...$routes,
            ...self::resource($model),
        ];
    }
}
