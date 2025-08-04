<?php

namespace App\Models;

use App\Traits\ModelSearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
