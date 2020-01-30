<?php

use Illuminate\Http\Request;

App\Helpers\RouteHelpers::resource('users', 'user', 'UserController');
App\Helpers\RouteHelpers::resource('warehouses', 'warehouse', 'WarehouseController');