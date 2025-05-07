<?php

namespace App\Helper;

class Common
{
    public static function dateTimeFormat($datetime): string
    {
        return $datetime->format('jS F, Y');
    }

    public static function getReadingTimeAttribute($text): string
    {
        $text = strip_tags($text);
        $wordCount = str_word_count($text);
        $minutes = ceil($wordCount / 200);
        return "Read time: {$minutes} min";
    }
}
