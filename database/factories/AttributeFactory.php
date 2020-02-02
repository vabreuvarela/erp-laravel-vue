<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Attribute;
use App\Models\Product;
use App\Models\Warehouse;
use Faker\Generator as Faker;

$factory->define(Attribute::class, function (Faker $faker) {
    $product = Product::select('id', 'cost')->first();

    return [
        'product_id' => $product->id,
        'warehouse_id' => Warehouse::select('id')->inRandomOrder()->first(),
        'wholesale_price' => $wholesalePrice = $faker->randomFloat(2, $product->cost * 2, $product->cost * 4),
        'retail_price' => $faker->randomFloat(2, $wholesalePrice * 2, $wholesalePrice * 4),
        'quantity' => $faker->numberBetween(0, 20)
    ];
});
