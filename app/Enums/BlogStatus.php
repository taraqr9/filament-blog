<?php

namespace App\Enums;

enum BlogStatus: string
{
    case Draft = 'draft';

    case Published = 'published';
    case Private = 'private';

    public function isPublished(): bool
    {
        return $this === BlogStatus::Published;
    }
}
