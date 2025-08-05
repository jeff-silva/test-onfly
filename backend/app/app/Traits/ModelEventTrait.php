<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ModelEventTrait
{
  protected static function bootModelEventTrait()
  {
    static::created(function ($entity) {
      $event = 'event.' . $entity->getTable() . '.created';
      event($event, [$entity]);
      Log::info($event, [$entity]);
    });

    static::updated(function ($entity) {
      $event = 'event.' . $entity->getTable() . '.updated';
      event($event, [$entity]);
      Log::info($event, [$entity]);
    });

    static::deleted(function ($entity) {
      $event = 'event.' . $entity->getTable() . '.deleted';
      event($event, [$entity]);
      Log::info($event, [$entity]);
    });
  }

  public function eventDispatch($event)
  {
    event($event, [$this]);
    Log::info($event, [$this]);
  }
}
