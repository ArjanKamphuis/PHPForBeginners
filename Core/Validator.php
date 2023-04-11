<?php

namespace Core;

class Validator
{
    public static function string(string $value, int $min = 1, int $max = PHP_INT_MAX): bool
    {
        $len = strlen(trim($value));
        return $len >= $min && $len <= $max;
    }

    public static function email(string $value): bool
    {
        return !! filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
