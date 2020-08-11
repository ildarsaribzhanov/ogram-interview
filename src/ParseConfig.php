<?php

namespace App;


/**
 * Class ParseConfig
 *
 * @package App
 */
class ParseConfig
{
    /**
     * @param string $str
     *
     * @return array
     */
    public static function parse(string $str): array
    {
        if (strpos($str, "=") === false) {
            return [];
        }

        [$key, $value] = explode("=", $str, 2);

        return [$key => $value];
    }
}