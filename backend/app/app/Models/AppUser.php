<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\AppUserRole;
use App\Traits\ModelSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AppUser extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, ModelSearchTrait, HasApiTokens;

    protected $table = 'app_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => AppUserRole::class,
        ];
    }

    /**
     * Get the trip requests for the user.
     */
    public function tripRequests(): HasMany
    {
        return $this->hasMany(TripRequest::class, 'user_id');
    }

    /**
     * Get the notifications for the user.
     */
    public function appNotifications(): HasMany
    {
        return $this->hasMany(AppNotification::class, 'user_id');
    }

    public function searchParams()
    {
        return [
            'roles' => [],
        ];
    }

    public function searchQuery($query, $params)
    {
        if (is_array($params->roles) and !empty($params->roles)) {
            $query->whereIn('role', $params->roles);
        }

        return $query;
    }
}
