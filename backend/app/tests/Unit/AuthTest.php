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
        $auth = $this->loginAs(null);
        $auth->response->assertStatus(200)->assertJsonStructure(['accessToken']);
        $response = $this->withToken($auth->token)->postJson('/api/auth/logout');
        $response->assertStatus(200)->assertJsonStructure(['message']);
    }
}
