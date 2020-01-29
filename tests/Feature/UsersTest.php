<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributes = factory('App\Models\User')->raw();
    }

    /**
     * @test
     */
    public function can_get_all_items()
    {
        factory('App\Models\User')->create();

        $this->json('get', '/api/users')->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_get_an_item()
    {
        factory('App\Models\User')->create();

        $this->json('get', '/api/users/' . User::select('id')->first()->id)->assertStatus(200);
    }

    /**
     * @test
     */
    public function can_create_an_item()
    {
        $this->json('post', '/api/users', $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('users', [
            'email' => $this->attributes['email']
        ]);
    }

    /**
     * @test
     */
    public function can_update_an_item()
    {
        $model = factory('App\Models\User')->create();

        $this->json('put', '/api/users/' . $model['id'], $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('users', [
            'email' => $this->attributes['email']
        ]);
    }

    /**
     * @test
     */
    public function can_delete_an_item()
    {
        $model = factory('App\Models\User')->create();

        $this->json('delete', '/api/users/' . $model['id'])->assertStatus(200);

        $this->assertSoftDeleted('users',  ['name' => $model['name'] ]);	
    }

    /**
     * @test
     */
    public function email_is_required_to_create_an_item()
    {
        $this->json('post', '/api/users', collect($this->attributes)->forget('email')->toArray())
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function name_is_required_to_create_an_item()
    {
        $this->json('post', '/api/users', collect($this->attributes)->forget('name')->toArray())
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function password_is_required_to_create_an_item()
    {
        $this->json('post', '/api/users', collect($this->attributes)->forget('password')->toArray())
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function name_is_required_to_update_an_item()
    {
        $model = factory('App\Models\User')->create();

        $this->json('put', '/api/users/' . $model['id'], collect($this->attributes)->forget('name')->toArray())
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function email_is_required_to_update_an_item()
    {
        $model = factory('App\Models\User')->create();

        $this->json('put', '/api/users/' . $model['id'], collect($this->attributes)->forget('email')->toArray())
            ->assertStatus(422);
    }

    /**
     * @test
     */
    public function password_is_not_required_to_update_an_item()
    {
        $model = factory('App\Models\User')->create();

        $this->json('put', '/api/users/' . $model['id'], collect($this->attributes)->forget('password')->toArray())
            ->assertStatus(200);
    }

}
