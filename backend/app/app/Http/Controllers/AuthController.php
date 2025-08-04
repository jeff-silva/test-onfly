<?php

namespace App\Http\Controllers;

use App\Models\AppNotification;
use App\Http\Requests\AppNotificationStoreRequest;
use App\Http\Requests\AppNotificationUpdateRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Models\AppUser;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Hash;
use App\Models\AppPersonalAccessToken;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $user = AppUser::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        $token = $user->createToken('main');
        $accessToken = $token->plainTextToken ?? null;
        $expiresAt = $token->accessToken ? $token->accessToken->expires_at : null;

        return compact(['accessToken', 'expiresAt']);
    }

    public function logout(Request $request)
    {
        $request->user('sanctum')->currentAccessToken()->delete();
        $message = 'Logged out';
        return compact(['message']);
    }
}
