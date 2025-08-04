<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;

class AppController extends Controller
{
    public function load(Request $request)
    {
        $scope = new Fluent();
        $scope->user = $request->user('sanctum');
        $scope->test = 123;
        return $scope;
    }
}
