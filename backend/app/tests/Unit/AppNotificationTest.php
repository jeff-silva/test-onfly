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

    public function test_index()
    {
        $admin = AppUser::find(1);
        $entities = AppNotification::factory()->count(3)->create();
        $response = $this->actingAs($admin, 'sanctum')->getJson('/api/app_notification');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_show()
    {
        $admin = AppUser::find(1);
        $entity = AppNotification::factory()->create();
        $response = $this->actingAs($admin, 'sanctum')->getJson("/api/app_notification/{$entity->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
    }

    public function test_store()
    {
        $admin = AppUser::find(1);
        $data = AppNotification::factory()->make()->toArray();

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/app_notification', $data);
        $response->assertStatus(200)
            ->assertJsonStructure(['entity' => ['id']]);

        $this->assertDatabaseHas('app_notification', [
            'subject' => $data['subject'],
        ]);
    }

    public function test_store_validation()
    {
        $admin = AppUser::find(1);
        $data = ['subject' => ''];
        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/app_notification', $data);
        $response->assertStatus(422)->assertJsonValidationErrors(['subject']);
    }

    public function test_update()
    {
        $admin = AppUser::find(1);
        $entity = AppNotification::factory()->create();
        $data = $entity->toArray();
        unset($data['id']);
        $data['subject'] = 'Updated';
        $response = $this->actingAs($admin, 'sanctum')->putJson("/api/app_notification/{$entity->id}", $data);
        $this->assertDatabaseHas('app_notification', ['id' => $entity->id]);
    }

    public function test_destroy()
    {
        $admin = AppUser::find(1);
        $delete = AppNotification::factory()->create();
        $response = $this->actingAs($admin, 'sanctum')->deleteJson("/api/app_notification/{$delete->id}");
        $response->assertStatus(200)->assertJsonStructure(['entity' => ['id']]);
        $this->assertDatabaseMissing('app_notification', ['id' => $delete->id]);
    }
}
