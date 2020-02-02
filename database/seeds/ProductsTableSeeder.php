<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouses = App\Models\Warehouse::all();

        factory(App\Models\Product::class, 5000)->create()->each(function ($product) use ($warehouses) {
            foreach ($warehouses as $warehouse) {
                factory(App\Models\Attribute::class)->create([
                    'warehouse_id' => $warehouse->id,
                    'product_id' => $product->id
                ]);
            }
        });
    }
}
