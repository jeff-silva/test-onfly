<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken;
use App\Traits\ModelSearchTrait;

class AppPersonalAccessToken extends PersonalAccessToken
{
  use ModelSearchTrait;

  protected $table = 'app_personal_access_token';
}
