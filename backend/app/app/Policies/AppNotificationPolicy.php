<?php

namespace App\Policies;

use App\Models\AppNotification;
use App\Models\AppUser;
use Illuminate\Auth\Access\Response;

class AppNotificationPolicy
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
    public function view(AppUser $appUser, AppNotification $appNotification): bool
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
    public function update(AppUser $appUser, AppNotification $appNotification): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(AppUser $appUser, AppNotification $appNotification): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(AppUser $appUser, AppNotification $appNotification): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(AppUser $appUser, AppNotification $appNotification): bool
    {
        return false;
    }
}
