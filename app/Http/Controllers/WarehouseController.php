<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\StoreWarehouseUserRelationshipRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use App\Models\Attribute;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Lang;

class WarehouseController extends Controller
{
    public function index()
    {
        return response()->json([Warehouse::paginate()], 200);
    }

    public function store(StoreWarehouseRequest $request)
    {
        return response()->json(['data' => [Warehouse::createOrUpdateItem($request)]], 200);
    }

    public function show(Warehouse $warehouse)
    {
        return response()->json(['data' => [$warehouse]], 200);
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        return response()->json(['data' => [Warehouse::createOrUpdateItem($request, $warehouse)]], 200);
    }

    public function destroy(Warehouse $warehouse)
    {
        return $warehouse->delete()
            ? response()->json(['message' => Lang::get('messages.deleted.success', ['name' => $warehouse->name])], 200)
            : response()->json(["message" => Lang::get('messages.deleted.fail', ['name' => $warehouse->name]), "errors" => []], 400);
    }

    public function restore(Warehouse $warehouse)
    {
        return $warehouse->restore()
            ? response()->json(['message' => Lang::get('messages.restored.success', ['name' => $warehouse->name])], 200)
            : response()->json(['message' => Lang::get('messages.restored.fail', ['name' => $warehouse->name]), 'errors' => []], 400);
    }

    public function attachUser(StoreWarehouseUserRelationshipRequest $request, Warehouse $warehouse)
    {
        $warehouse->users()->attach($request->user_id);

        return $warehouse->users()->where('user_id', $request->user_id)->exists()
            ? response()->json(['message' => Lang::get('messages.attached.success', ['name' => $warehouse->name])], 200)
            : response()->json(['message' => Lang::get('messages.attached.fail', ['name' => $warehouse->name]), 'errors' => []], 400);
    }

    public function detachUser(Warehouse $warehouse, $id)
    {
        return $warehouse->users()->detach($id)
            ? response()->json(['message' => Lang::get('messages.detached.success', ['name' => $warehouse->name])], 200)
            : response()->json(['message' => Lang::get('messages.detached.fail', ['name' => $warehouse->name]), 'errors' => []], 400);
    }

    public function products($warehouseId)
    {
        return response()->json([Attribute::where('warehouse_id', $warehouseId)->with('product')->paginate()], 200);
    }
}
