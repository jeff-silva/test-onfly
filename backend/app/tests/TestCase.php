<?php

namespace Tests;

use App\Models\AppUser;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Fluent;

abstract class TestCase extends BaseTestCase
{
    /**
     * Faz login como um usuário com o email definido (ou cria um usuário caso email seja null)
     * Retorna objeto contendo:
     * - response: Resposta da request de login
     * - entity: usuário encontrado com o login
     * - token: string do token de acesso
     */
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
