<?php
namespace Extyl\Spasibo\Partners\Tools;

class Lang
{
    public static function getNumericString($number, $strings, $others  = [])
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        $others['{val}'] = $number;
        return str_replace(
            array_keys($others),
            $others,
            $strings[($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)]]
        );
    }
}
