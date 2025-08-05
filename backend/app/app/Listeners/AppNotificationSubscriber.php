<?php

namespace App\Listeners;

use App\Models\AppNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Events\Dispatcher;

class AppNotificationSubscriber
{
    public function subscribe(Dispatcher $events): array
    {
        return [
            'event.trip_request.approved' => 'onTripRequestApproved',
            'event.trip_request.denied' => 'onTripRequestDenied',
        ];
    }

    public function onTripRequestApproved($entity)
    {
        AppNotification::create([
            'user_id' => $entity->user_id,
            'subject' => 'Viagem Aprovada',
            'body' => "Sua viagem para {$entity->destination} foi aprovada",
        ]);
    }

    public function onTripRequestDenied($entity)
    {
        AppNotification::create([
            'user_id' => $entity->user_id,
            'subject' => 'Viagem Negada',
            'body' => "Sua viagem para {$entity->destination} foi negada",
        ]);
    }
}
