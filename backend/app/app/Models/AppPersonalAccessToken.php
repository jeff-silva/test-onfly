<?php

namespace App\Models;

use App\Traits\ModelEventTrait;
use Laravel\Sanctum\PersonalAccessToken;
use App\Traits\ModelSearchTrait;

class AppPersonalAccessToken extends PersonalAccessToken
{
  use ModelSearchTrait, ModelEventTrait;

  protected $table = 'app_personal_access_token';
}
