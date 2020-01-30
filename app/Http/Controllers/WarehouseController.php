<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        return response()->json([
            Warehouse::paginate()
        ], 200);
    }

    public function store(StoreWarehouseRequest $request)
    {
        return response()->json([ 'data' => [ Warehouse::createOrUpdateItem($request) ] ], 200);
    }

    public function show(Warehouse $warehouse)
    {
        return response()->json([ 'data' => [ $warehouse ] ], 200);
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        return response()->json([ 'data' => [ Warehouse::createOrUpdateItem($request, $warehouse) ] ], 200);
    }

    public function destroy(Warehouse $warehouse)
    {
        return $warehouse->delete()
            ? response()->json([ 'message' => $warehouse->id . trans('messages.deleted.success') ], 200)
            : response()->json([
                "message" => $warehouse->id . trans('messages.deleted.failed'),
                "errors" => []
            ], 400);
    }

    public function restore(Warehouse $warehouse)
    {
        return $warehouse->restore()
            ? response()->json([ 'message' => $warehouse->id . trans('messages.restored.success') ], 200)
            : response()->json([
                    'message' => $warehouse->id . trans('messages.restored.failed'),
                    'errors' => []
                ], 400);
    }
}