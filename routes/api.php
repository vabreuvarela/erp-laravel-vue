<?php

use Illuminate\Http\Request;

App\Helpers\RouteHelpers::resource('user');
App\Helpers\RouteHelpers::resourceWithRelationships('warehouse', [ 'user' ]);
