<?php

namespace App\Models;

use App\Traits\ModelSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    /** @use HasFactory<\Database\Factories\AppNotificationFactory> */
    use HasFactory, ModelSearchTrait;

    protected $table = 'app_notification';
    protected $fillable = [
        'user_id',
        'subject',
        'body',
    ];
}
