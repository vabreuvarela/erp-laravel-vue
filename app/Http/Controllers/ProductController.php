<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([Product::paginate()], 200);
    }

    public function store(StoreProductRequest $request)
    {
        return response()->json(['data' => [Product::createOrUpdateItem($request)]], 200);
    }

    public function show(Product $product)
    {
        return response()->json(['data' => [$product]], 200);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return response()->json(['data' => [Product::createOrUpdateItem($request, $product)]], 200);
    }

    public function destroy(Product $product)
    {
        return $product->delete()
            ? response()->json(['message' => Lang::get('messages.deleted.success', ['name' => $product->name])], 200)
            : response()->json(["message" =>  Lang::get('messages.deleted.fail', ['name' => $product->name]), "errors" => []], 400);
    }

    public function restore(Product $product)
    {
        return $product->restore()
            ? response()->json(['message' => Lang::get('messages.restored.success', ['name' => $product->name])], 200)
            : response()->json(['message' => Lang::get('messages.restored.fail', ['name' => $product->name]), 'errors' => []], 400);
    }
}
