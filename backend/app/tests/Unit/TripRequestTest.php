<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AppUser;
use App\Models\TripRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripRequestTest extends TestCase
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
        TripRequest::factory()->count(3)->create();

        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/trip_request');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_show()
    {
        $admin = AppUser::find(1);
        $entity = TripRequest::factory()->create();
        $response = $this->actingAs($admin, 'sanctum')->getJson("/api/trip_request/{$entity->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
    }

    public function test_store()
    {
        $admin = AppUser::find(1);
        $data = TripRequest::factory()->make()->toArray();

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/trip_request', $data);
        $response->assertStatus(200)
            ->assertJsonStructure(['entity' => ['id']]);

        $this->assertDatabaseHas('trip_request', [
            'name' => $data['name'],
        ]);
    }

    public function test_store_validation()
    {
        $admin = AppUser::find(1);
        $data = ['name' => ''];
        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/trip_request', $data);
        $response->assertStatus(422)->assertJsonValidationErrors(['name']);
    }

    public function test_update()
    {
        $admin = AppUser::find(1);
        $entity = TripRequest::factory()->create();
        $data = ['name' => 'Updated Name'];
        $response = $this->actingAs($admin, 'sanctum')->putJson("/api/trip_request/{$entity->id}", $data);
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Updated Name']);
        $this->assertDatabaseHas('trip_request', array_merge(['id' => $entity->id], $data));
    }

    public function test_destroy()
    {
        $admin = AppUser::find(1);
        $delete = TripRequest::factory()->create();
        $response = $this->actingAs($admin, 'sanctum')->deleteJson("/api/trip_request/{$delete->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
        $this->assertDatabaseMissing('trip_request', ['id' => $delete->id]);
    }
}
