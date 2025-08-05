<?php

namespace App\Providers;

use App\Listeners\AppNotificationSubscriber;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(\App\Models\AppPersonalAccessToken::class);
        Event::subscribe(AppNotificationSubscriber::class);
    }
}
