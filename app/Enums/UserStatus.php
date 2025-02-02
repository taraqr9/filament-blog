<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'active';

    case InActive = 'inactive';

    public function isActive(): bool
    {
        return $this === UserStatus::Active;
    }
}
