<?php

namespace App\Models;

use App\Enums\AppUserRole;
use App\Traits\ModelEventTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\ModelSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Log;

class TripRequest extends Model
{
    /** @use HasFactory<\Database\Factories\TripRequestFactory> */
    use HasFactory, ModelSearchTrait, ModelEventTrait;

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

    /**
     * Get the user that owns the trip request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(AppUser::class, 'user_id');
    }

    public function searchParams()
    {
        return [
            'user_id' => null,
            'status' => null,
            'date_start' => null,
            'date_final' => null,
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

        if ($params->status) {
            $query->where('status', $params->status);
        }

        if ($params->date_start) {
            $query->where(function ($q) use ($params) {
                $q->where('departure_date', '>=', $params->date_start);
                $q->orWhere('return_date', '>=', $params->date_start);
            });
        }

        if ($params->date_final) {
            $query->where(function ($q) use ($params) {
                $q->where('departure_date', '<=', $params->date_final);
                $q->orWhere('return_date', '<=', $params->date_final);
            });
        }

        return $query;
    }
}
