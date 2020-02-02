<?php

namespace Tests\Feature;

use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WarehousesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributes = factory('App\Models\Warehouse')->raw();
    }

    /**
     * @test
     */
    public function can_get_all_items()
    {
        factory('App\Models\Warehouse')->create();

        $this->json('get', '/api/warehouse')->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_get_an_item()
    {
        factory('App\Models\Warehouse')->create();

        $this->json('get', '/api/warehouse/' . Warehouse::select('id')->first()->id)->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_create_an_item()
    {
        $this->json('post', '/api/warehouse', $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('warehouses', ['name' => $this->attributes['name']]);
    }

    /**
     * @test
     */
    public function can_update_an_item()
    {
        $model = factory('App\Models\Warehouse')->create();

        $this->json('put', '/api/warehouse/' . $model['id'], $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('warehouses', ['name' => $this->attributes['name']]);
    }

    /**
     * @test
     */
    public function can_delete_an_item()
    {
        $model = factory('App\Models\Warehouse')->create();

        $this->json('delete', '/api/warehouse/' . $model['id'])->assertStatus(200);

        $this->assertSoftDeleted('warehouses',  ['name' => $model['name']]);
    }

    /**
     * @test
     */
    public function name_is_required_to_create_an_item()
    {
        $this->json('post', '/api/warehouse', collect($this->attributes)->forget('name')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function debt_is_required_to_create_an_item()
    {
        $this->json('post', '/api/warehouse', collect($this->attributes)->forget('debt')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function name_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Warehouse')->create();

        $this->json('put', '/api/warehouse/' . $model['id'], collect($this->attributes)->forget('name')->toArray())->assertStatus(422);
    }

    /**
     * @test
     */
    public function debt_is_required_to_update_an_item()
    {
        $model = factory('App\Models\Warehouse')->create();

        $this->json('put', '/api/warehouse/' . $model['id'], collect($this->attributes)->forget('debt')->toArray())->assertStatus(422);
    }
}
