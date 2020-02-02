<?php

App\Helpers\RouteHelpers::resource('user');
App\Helpers\RouteHelpers::resourceWithRelationships('warehouse', ['user']);
App\Helpers\RouteHelpers::resourceWithRelationships('product', ['warehouse']);

Route::post('attribute', 'AttributeController@store');
Route::get('warehouse/{warehouseId}/product', 'WarehouseController@products');
Route::put('warehouse/{warehouseId}/product/{productId}', 'AttributeController@update');
