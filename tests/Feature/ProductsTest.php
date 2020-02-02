<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributes = factory('App\Models\Product')->raw();
    }

    /**
     * @test
     */
    public function can_get_all_items()
    {
        factory('App\Models\Product')->create();

        $this->json('get', '/api/product')->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_get_an_item()
    {
        factory('App\Models\Product')->create();

        $this->json('get', '/api/product/' . Product::select('id')->first()->id)->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_create_an_item()
    {
        $this->json('post', '/api/product', $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('products', ['name' => $this->attributes['name']]);
    }

    /**
     * @test
     */
    public function can_update_an_item()
    {
        $model = factory('App\Models\Product')->create();

        $this->json('put', '/api/product/' . $model['id'], $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('products', ['name' => $this->attributes['name']]);
    }

    /**
     * @test
     */
    public function can_delete_an_item()
    {
        $model = factory('App\Models\Product')->create();

        $this->json('delete', '/api/product/' . $model['id'])->assertStatus(200);

        $this->assertSoftDeleted('products',  ['name' => $model['name']]);
    }

    /**
     * @test
     */
    public function name_is_required_to_create_an_item()
    {
        $this->json('post', '/api/product', collect($this->attributes)->forget('name')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function sku_is_required_to_create_an_item()
    {
        $this->json('post', '/api/product', collect($this->attributes)->forget('sku')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function upc_is_required_to_create_an_item()
    {
        $this->json('post', '/api/product', collect($this->attributes)->forget('upc')->toArray())->assertStatus(422);
    }


    /**
     * @test
     */
    public function cost_is_required_to_create_an_item()
    {
        $this->json('post', '/api/product', collect($this->attributes)->forget('cost')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function name_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Product')->create();

        $this->json('put', '/api/product/' . $model['id'], collect($this->attributes)->forget('name')->toArray())->assertStatus(422);
    }
    /**
     * @test
     */
    public function sku_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Product')->create();

        $this->json('put', '/api/product/' . $model['id'], collect($this->attributes)->forget('sku')->toArray())->assertStatus(422);
    }
    /**
     * @test
     */
    public function upc_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Product')->create();

        $this->json('put', '/api/product/' . $model['id'], collect($this->attributes)->forget('upc')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function cost_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Product')->create();

        $this->json('put', '/api/product/' . $model['id'], collect($this->attributes)->forget('cost')->toArray())->assertStatus(422);
    }
}
