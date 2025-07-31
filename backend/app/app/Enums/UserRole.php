<?php

namespace App\Enums;

enum UserRole: string
{
  case User = 'user';
  case Admin = 'admin';

  public function label(): string
  {
    return match ($this) {
      self::User => 'user',
      self::Admin => 'admin',
    };
  }

  public function isFinished(): bool
  {
    return in_array($this, [self::User, self::Admin]);
  }
}
