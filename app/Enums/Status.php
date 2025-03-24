<?php

namespace App\Enums;

enum Status: string
{
    case Active = 'active';

    case InActive = 'inactive';

    public function isActive(): bool
    {
        return $this === Status::Active;
    }
}
