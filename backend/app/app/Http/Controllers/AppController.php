<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;

class AppController extends Controller
{
    public function load(Request $request)
    {
        $scope = new Fluent();
        $scope->user = null;
        $scope->notifications = [];

        if ($user = $request->user('sanctum')) {
            $scope->user = $user;
            $scope->notifications = $user->notifications()->orderBy('id', 'DESC')->get();
        }

        return $scope;
    }
}
