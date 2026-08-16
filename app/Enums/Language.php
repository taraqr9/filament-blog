<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Language: string implements HasLabel
{
    case English = 'en';
    case Italian = 'it';
    case French = 'fr';
    case Spanish = 'es';
    case German = 'de';
    case Portuguese = 'pt';
    case Chinese = 'zh';
    case Japanese = 'ja';

    public function getLabel(): string
    {
        return match ($this) {
            self::English => 'English',
            self::Italian => 'Italian',
            self::French => 'French',
            self::Spanish => 'Spanish',
            self::German => 'German',
            self::Portuguese => 'Portuguese',
            self::Chinese => 'Chinese',
            self::Japanese => 'Japanese',
        };
    }
}
