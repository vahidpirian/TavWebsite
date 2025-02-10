<?php

namespace App\Http\Services;

class SluggableService
{
    public static function method($string, $separator = '-'){
        $string = strip_tags($string);
        $string = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $string);

        return trim($string, $separator);
    }
}
