<?php

namespace App\AppFunction;

class Common
{
    public static function clearNumberFormat($formatted) {
        return str_replace(",", "", $formatted);
    }
}
