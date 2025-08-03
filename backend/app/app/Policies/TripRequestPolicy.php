<?php

namespace App\Policies;

use App\Models\AppUser;
use App\Models\TripRequest;
use Illuminate\Auth\Access\Response;

class TripRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(AppUser $appUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(AppUser $appUser, TripRequest $tripRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(AppUser $appUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(AppUser $appUser, TripRequest $tripRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(AppUser $appUser, TripRequest $tripRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(AppUser $appUser, TripRequest $tripRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(AppUser $appUser, TripRequest $tripRequest): bool
    {
        return false;
    }
}
