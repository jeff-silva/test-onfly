<?php

namespace Tests;

use App\Models\AppUser;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Fluent;

abstract class TestCase extends BaseTestCase
{
    public function loginAs($email)
    {
        $entity = AppUser::where(['email' => $email])->first();
        if (!$entity) $entity = AppUser::factory()->create();
        $data = ['email' => $entity->email, 'password' => $entity->email];
        $response = $this->postJson('/api/auth/login', $data);
        $token = $response->json('accessToken');
        return new Fluent(compact(['response', 'entity', 'token']));
    }
}
