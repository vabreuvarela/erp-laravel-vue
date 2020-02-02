<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function store(StoreAttributeRequest $request)
    {
        return response()->json(['data' => [Attribute::createOrUpdateItem($request)]], 200);
    }

    public function update(UpdateAttributeRequest $request, $warehouseId, $productId)
    {
        $attribute = Attribute::where('warehouse_id', $warehouseId)->where('product_id', $productId)->firstOrFail();

        return response()->json(['data' => [Attribute::createOrUpdateItem($request, $attribute)]], 200);
    }
}
