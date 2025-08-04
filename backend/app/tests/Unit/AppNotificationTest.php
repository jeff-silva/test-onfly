<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AppUser;
use App\Models\AppNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_cant_see_data_without_token()
    {
        $response = $this->getJson('/api/app_notification');
        $response->assertStatus(401);

        $response = $this->postJson('/api/app_notification', []);
        $response->assertStatus(401);

        $response = $this->putJson('/api/app_notification/1', []);
        $response->assertStatus(401);

        $response = $this->getJson('/api/app_notification/1', []);
        $response->assertStatus(401);

        $response = $this->deleteJson('/api/app_notification/1', []);
        $response->assertStatus(401);
    }

    public function test_index()
    {
        $auth = $this->loginAs('main@grr.la');
        $entities = AppNotification::factory()->count(3)->create();
        $response = $this->withToken($auth->token)->getJson('/api/app_notification');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_show()
    {
        $auth = $this->loginAs('main@grr.la');
        $entity = AppNotification::factory()->create();
        $response = $this->withToken($auth->token)->getJson("/api/app_notification/{$entity->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
    }

    public function test_store()
    {
        $auth = $this->loginAs('main@grr.la');
        $data = AppNotification::factory()->make()->toArray();
        $response = $this->withToken($auth->token)->postJson('/api/app_notification', $data);
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
        $this->assertDatabaseHas('app_notification', ['subject' => $data['subject']]);
    }

    public function test_store_validation()
    {
        $auth = $this->loginAs('main@grr.la');
        $data = ['subject' => ''];
        $response = $this->withToken($auth->token)->postJson('/api/app_notification', $data);
        $response->assertStatus(422)->assertJsonValidationErrors(['subject']);
    }

    public function test_update()
    {
        $auth = $this->loginAs('main@grr.la');
        $entity = AppNotification::factory()->create();
        $data = $entity->toArray();
        unset($data['id']);
        $data['subject'] = 'Updated';
        $response = $this->withToken($auth->token)->putJson("/api/app_notification/{$entity->id}", $data);
        $this->assertDatabaseHas('app_notification', ['id' => $entity->id]);
    }

    public function test_destroy()
    {
        $auth = $this->loginAs('main@grr.la');
        $delete = AppNotification::factory()->create();
        $response = $this->withToken($auth->token)->deleteJson("/api/app_notification/{$delete->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
        $this->assertDatabaseMissing('app_notification', ['id' => $delete->id]);
    }
}
