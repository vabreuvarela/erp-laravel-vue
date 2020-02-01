<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Support\ServiceProvider;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('user', function ($value) {
            return User::where('id', $value)->with('warehouses')->withTrashed()->firstOrFail();
        });

        Route::bind('warehouse', function ($value) {
            return Warehouse::where('id', $value)->with('users')->withTrashed()->firstOrFail();
        });
    }
}
