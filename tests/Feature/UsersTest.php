<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AttachJwtToken;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use AttachJwtToken;

    protected $attributes;

    protected function setUp(): void
    {
        parent::setUp();

        $this->attributes = factory('App\Models\User')->raw();
    }

    public function testAdminCanGetAllItems()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));
        $this->json('get', '/api/user')->assertStatus(200);
    }

    public function testVisitorCantGetAllItems()
    {
        $this->json('get', '/api/user')->assertStatus(403);
    }

    public function testAdminCanGetAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));
        $this->json('get', '/api/user/' . User::select('id')->first()->id)->assertStatus(200);
    }

    public function testVisitorCantGetAnItem()
    {
        factory('App\Models\User')->create();
        $this->json('get', '/api/user/' . User::select('id')->first()->id)->assertStatus(403);
    }

    public function testAdminCanCreateAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('post', '/api/user', $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('users', ['email' => $this->attributes['email']]);
    }

    public function testVisitorCantCreateAnItem()
    {
        $this->json('post', '/api/user', $this->attributes)
            ->assertStatus(403);
    }

    public function testAdminCanUpdateAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $model = factory('App\Models\User')->create();

        $this->json('put', '/api/user/' . $model['id'], $this->attributes)
            ->assertStatus(200)
            ->assertJsonFragment(['name' => $this->attributes['name']]);

        $this->assertDatabaseHas('users', ['email' => $this->attributes['email']]);
    }

    public function testVisitorCantUpdateAnItem()
    {
        $model = factory('App\Models\User')->create();

        $this->json('put', '/api/user/' . $model['id'], $this->attributes)
            ->assertStatus(403);
    }

    public function testAdminCanDeleteAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $model = factory('App\Models\User')->create();

        $this->json('delete', '/api/user/' . $model['id'])->assertStatus(200);

        $this->assertSoftDeleted('users',  ['name' => $model['name']]);
    }

    public function testVisitorCantDeleteAnItem()
    {
        $model = factory('App\Models\User')->create();

        $this->json('delete', '/api/user/' . $model['id'])->assertStatus(403);
    }

    public function testEmailIsRequiredToCreateAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('post', '/api/user', collect($this->attributes)->forget('email')->toArray())->assertStatus(422);
    }

    public function testNameIsRequiredToCreateAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('post', '/api/user', collect($this->attributes)->forget('name')->toArray())->assertStatus(422);
    }

    public function testPasswordIsRequiredToCreateAnItem()
    {
        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('post', '/api/user', collect($this->attributes)->forget('password')->toArray())->assertStatus(422);
    }

    public function testNameIsRequiredToUpdateAnItem()
    {

        $model = factory('App\Models\User')->create();

        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('put', '/api/user/' . $model['id'], collect($this->attributes)->forget('name')->toArray())->assertStatus(422);
    }

    public function testEmailIsRequiredToUpdateAnItem()
    {
        $model = factory('App\Models\User')->create();

        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('put', '/api/user/' . $model['id'], collect($this->attributes)->forget('email')->toArray())->assertStatus(422);
    }

    public function testPasswordIsRequiredToUpdateAnItem()
    {
        $model = factory('App\Models\User')->create();

        $this->loginAs(factory('App\Models\User')->create(['is_admin' => true]));

        $this->json('put', '/api/user/' . $model['id'], collect($this->attributes)->forget('password')->toArray())->assertStatus(200);
    }
}
