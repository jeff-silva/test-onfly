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
        $data = ['email' => $entity->email, 'password' => $entity->email];
        $response = $this->postJson('/api/auth/login', $data);
        $token = $response->json('accessToken');
        return new Fluent(['entity' => $entity, 'token' => $token]);
    }
}
