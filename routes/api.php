<?php

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('login', 'AuthenticationController@login')->name('login');
    Route::post('logout', 'AuthenticationController@logout')->name('logout');
    Route::post('refresh', 'AuthenticationController@refresh')->name('refresh');
});

App\Helpers\RouteHelpers::resource('user');
App\Helpers\RouteHelpers::resourceWithRelationships('warehouse', ['user']);
App\Helpers\RouteHelpers::resourceWithRelationships('product', ['warehouse']);

Route::post('attribute', 'AttributeController@store');
Route::get('warehouse/{warehouseId}/product', 'WarehouseController@products');
Route::put('warehouse/{warehouseId}/product/{productId}', 'AttributeController@update');
