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

    public function test_cant_see_data_without_token()
    {
        $response = $this->getJson('/api/trip_request');
        $response->assertStatus(401);

        $response = $this->postJson('/api/trip_request', []);
        $response->assertStatus(401);

        $response = $this->putJson('/api/trip_request/1', []);
        $response->assertStatus(401);

        $response = $this->getJson('/api/trip_request/1', []);
        $response->assertStatus(401);

        $response = $this->deleteJson('/api/trip_request/1', []);
        $response->assertStatus(401);
    }

    public function test_index()
    {
        $auth = $this->loginAs('main@grr.la');
        TripRequest::factory()->count(3)->create();

        $response = $this->withToken($auth->token)->getJson('/api/trip_request');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_show()
    {
        $auth = $this->loginAs('main@grr.la');
        $entity = TripRequest::factory()->create();
        $response = $this->withToken($auth->token)->getJson("/api/trip_request/{$entity->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
    }

    public function test_store()
    {
        $auth = $this->loginAs('main@grr.la');
        $data = TripRequest::factory()->make()->toArray();

        $response = $this->withToken($auth->token)->postJson('/api/trip_request', $data);
        $response->assertStatus(200)
            ->assertJsonStructure(['entity' => ['id']]);

        $this->assertDatabaseHas('trip_request', [
            'name' => $data['name'],
        ]);
    }

    public function test_store_validation()
    {
        $auth = $this->loginAs('main@grr.la');
        $data = ['name' => ''];
        $response = $this->withToken($auth->token)->postJson('/api/trip_request', $data);
        $response->assertStatus(422)->assertJsonValidationErrors(['name']);
    }

    public function test_update()
    {
        $auth = $this->loginAs('main@grr.la');
        $entity = TripRequest::factory()->create();
        $data = $entity->toArray();
        unset($data['id']);
        $data['name'] = 'Updated';
        $response = $this->withToken($auth->token)->putJson("/api/trip_request/{$entity->id}", $data);
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Updated']);
        $this->assertDatabaseHas('trip_request', ['id' => $entity->id]);
    }

    public function test_destroy()
    {
        $auth = $this->loginAs('main@grr.la');
        $delete = TripRequest::factory()->create();
        $response = $this->withToken($auth->token)->deleteJson("/api/trip_request/{$delete->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
        $this->assertDatabaseMissing('trip_request', ['id' => $delete->id]);
    }
}
