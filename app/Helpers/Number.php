<?php

namespace App\Helpers;

class Number
{
    /**
     * Normaliza uma string para valor numérico.
     */
    public static function normalizeStringToNumber(string $value = null)
    {
        if (!$value) {
            return $value;
        }

        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);

        return (float) $value;
    }
}
