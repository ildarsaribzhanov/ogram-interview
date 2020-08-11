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

        return self::parseKey($key . ".", $value);
    }

    /**
     * @param string $key
     * @param string $val
     *
     * @return array[]|string[]|\string[][]
     */
    private static function parseKey(string $key, string $val)
    {
        [$keyUp, $keyIn] = explode('.', $key, 2);

        if (!$keyIn) {
            return [$keyUp => $val];
        }

        return [$keyUp => self::parseKey($keyIn, $val)];
    }
}