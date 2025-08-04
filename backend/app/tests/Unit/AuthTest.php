<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AppUser;
use App\Models\TripRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Fluent;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_login_logout()
    {
        $entity = AppUser::factory()->create();
        $data = ['email' => $entity->email, 'password' => $entity->email];

        $response = $this->postJson('/api/auth/login', $data);
        $response->assertStatus(200)->assertJsonStructure(['accessToken']);

        $accessToken = $response->json('accessToken');
        $response = $this->withToken($accessToken)->postJson('/api/auth/logout');
        $response->assertStatus(200)->assertJsonStructure(['message']);
    }
}
