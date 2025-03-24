<?php

namespace App\Helper;

class Common
{
    public static function dateTimeFormat($datetime): string
    {
        return $datetime->format('jS F, Y');
    }
}
