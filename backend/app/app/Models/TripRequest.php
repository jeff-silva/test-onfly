<?php

namespace App\Models;

use App\Enums\AppUserRole;
use App\Traits\ModelSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TripRequest extends Model
{
    /** @use HasFactory<\Database\Factories\TripRequestFactory> */
    use HasFactory, ModelSearchTrait;

    protected $table = 'trip_request';
    protected $fillable = [
        'name',
        'destination',
        'departure_date',
        'return_date',
        'user_id',
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function searchParams()
    {
        return [
            'user_id' => null,
        ];
    }

    public function searchQuery($query, $params)
    {
        if ($user = request()->user('sanctum')) {
            if ($user->role->value == 'user') {
                $params->user_id = $user->id;
            }
        }

        if ($params->user_id) {
            $query->where('user_id', $params->user_id);
        }

        Log::info($params);
        return $query;
    }
}
