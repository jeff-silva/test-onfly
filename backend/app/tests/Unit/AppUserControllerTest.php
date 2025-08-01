<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AppUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_index()
    {
        $admin = AppUser::find(1);
        AppUser::factory()->count(3)->create();
        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/app_user');
        // $response->assertStatus(200)->assertJsonCount(5);
        dump($response->getData());
    }

    // public function test_show()
    // {
    //     $admin = AppUser::find(1);
    //     $response = $this->actingAs($admin, 'sanctum')->getJson("/api/app_user/{$admin->id}");
    //     $response->assertStatus(200)->assertJsonStructure(['entity' => ['id', 'name', 'email']]);
    // }

    // public function test_store()
    // {
    //     $admin = AppUser::find(1);
    //     $data = AppUser::factory()->make()->toArray();
    //     $data['password'] = $data['email'];

    //     $response = $this->actingAs($admin, 'sanctum')->postJson('/api/app_user', $data);
    //     $response->assertStatus(200)
    //         ->assertJsonStructure(['entity' => ['id', 'name', 'email']])
    //         ->assertJson([
    //             'entity' => ['name' => $data['name'], 'email' => $data['email']]
    //         ]);

    //     $this->assertDatabaseHas('app_user', [
    //         'email' => $data['email'],
    //     ]);
    // }

    // public function test_store_validation()
    // {
    //     $admin = AppUser::find(1);
    //     $userData = ['name' => '', 'email' => 'not-an-email', 'password' => ''];
    //     $response = $this->actingAs($admin, 'sanctum')->postJson('/api/app_user', $userData);
    //     $response->assertStatus(422)->assertJsonValidationErrors(['name', 'email', 'password']);
    // }

    // public function test_update()
    // {
    //     $admin = AppUser::find(1);
    //     $user = AppUser::factory()->create();
    //     $data = ['name' => 'Updated Name', 'email' => 'updated@example.com'];
    //     $response = $this->actingAs($admin, 'sanctum')->putJson("/api/app_user/{$user->id}", $data);
    //     $response->assertStatus(200)->assertJsonFragment(['name' => 'Updated Name']);
    //     $this->assertDatabaseHas('app_user', array_merge(['id' => $user->id], $data));
    // }

    // public function test_destroy()
    // {
    //     $admin = AppUser::find(1);
    //     $delete = AppUser::factory()->create();
    //     $response = $this->actingAs($admin, 'sanctum')->deleteJson("/api/app_user/{$delete->id}");
    //     $response->assertStatus(200)->assertJsonStructure(['entity' => ['id', 'name', 'email']]);
    //     $this->assertDatabaseMissing('app_user', ['id' => $delete->id]);
    // }
}
