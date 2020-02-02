<?php

namespace Tests\Feature;

use App\Models\Attribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $product = factory('App\Models\Product')->create();
        $warehouse = factory('App\Models\Warehouse')->create();

        $this->attributes = factory('App\Models\Attribute')->raw();

        $this->attributes['product_id'] = $product->id;
        $this->attributes['warehouse_id'] = $warehouse->id;
    }


    /**
     * @test
     */
    public function can_create_an_item()
    {
        $this->json('post', '/api/attribute', $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment([
                'product_id' => $this->attributes['product_id'],
                'warehouse_id' => $this->attributes['warehouse_id'],
                'wholesale_price' => $this->attributes['wholesale_price'],
                'retail_price' => $this->attributes['retail_price'],
                'quantity' => $this->attributes['quantity']
            ]);

        $this->assertDatabaseHas('attributes', [
            'product_id' => $this->attributes['product_id'],
            'warehouse_id' => $this->attributes['warehouse_id'],
            'wholesale_price' => $this->attributes['wholesale_price'],
            'retail_price' => $this->attributes['retail_price'],
            'quantity' => $this->attributes['quantity']
        ]);
    }

    /**
     * @test
     */
    public function can_update_an_item()
    {
        $model = factory('App\Models\Attribute')->create();

        $this->json('put', '/api/warehouse/' . $model['warehouse_id'] . '/product/' . $model['product_id'], $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment([
                'wholesale_price' => $this->attributes['wholesale_price'],
                'retail_price' => $this->attributes['retail_price'],
                'quantity' => $this->attributes['quantity']
            ]);

        $this->assertDatabaseHas('attributes', [
            'wholesale_price' => $this->attributes['wholesale_price'],
            'retail_price' => $this->attributes['retail_price'],
            'quantity' => $this->attributes['quantity']
        ]);
    }


    /**
     * @test
     */
    public function product_id_is_required_to_create_an_item()
    {
        $this->json('post', '/api/attribute', collect($this->attributes)->forget('product_id')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function warehouse_id_is_required_to_create_an_item()
    {
        $this->json('post', '/api/attribute', collect($this->attributes)->forget('warehouse_id')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function wholesale_price_is_required_to_create_an_item()
    {
        $this->json('post', '/api/attribute', collect($this->attributes)->forget('wholesale_price')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function retail_price_is_required_to_create_an_item()
    {
        $this->json('post', '/api/attribute', collect($this->attributes)->forget('retail_price')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function quantity_is_required_to_create_an_item()
    {
        $this->json('post', '/api/attribute', collect($this->attributes)->forget('quantity')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function wholesale_price_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Attribute')->create();

        $this->json('put', '/api/warehouse/' . $model['warehouse_id'] . '/product/' . $model['product_id'], collect($this->attributes)->forget('wholesale_price')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function retail_price_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Attribute')->create();

        $this->json('put', '/api/warehouse/' . $model['warehouse_id'] . '/product/' . $model['product_id'], collect($this->attributes)->forget('retail_price')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function quantity_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Attribute')->create();

        $this->json('put', '/api/warehouse/' . $model['warehouse_id'] . '/product/' . $model['product_id'], collect($this->attributes)->forget('quantity')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function warehouse_id_cant_be_updated()
    {
        $model = factory('App\Models\Attribute')->create();

        $this->json('put', '/api/warehouse/' . $model['warehouse_id'] . '/product/' . $model['product_id'], collect($this->attributes)->toArray())->assertJsonFragment([
            'id' => $model['id'],
            'warehouse_id' => $model['warehouse_id'],
            'wholesale_price' => $this->attributes['wholesale_price'],
            'retail_price' => $this->attributes['retail_price'],
            'quantity' => $this->attributes['quantity']
        ]);

        $this->assertDatabaseHas('attributes', [
            'id' => $model['id'],
            'warehouse_id' => $model['warehouse_id'],
            'wholesale_price' => $this->attributes['wholesale_price'],
            'retail_price' => $this->attributes['retail_price'],
            'quantity' => $this->attributes['quantity']
        ]);
    }

    /**
     * @test
     */
    public function product_id_cant_be_updated()
    {
        $model = factory('App\Models\Attribute')->create();

        $this->json('put', '/api/warehouse/' . $model['warehouse_id'] . '/product/' . $model['product_id'], collect($this->attributes)->toArray())->assertJsonFragment([
            'id' => $model['id'],
            'product_id' => $model['product_id'],
            'wholesale_price' => $this->attributes['wholesale_price'],
            'retail_price' => $this->attributes['retail_price'],
            'quantity' => $this->attributes['quantity']
        ]);

        $this->assertDatabaseHas('attributes', [
            'id' => $model['id'],
            'product_id' => $model['product_id'],
            'wholesale_price' => $this->attributes['wholesale_price'],
            'retail_price' => $this->attributes['retail_price'],
            'quantity' => $this->attributes['quantity']
        ]);
    }
}
