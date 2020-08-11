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
        $lineList = explode(PHP_EOL, $str);

        $res = [];

        foreach ($lineList as $line) {
            if (empty($line)) {
                continue;
            }

            $res = array_merge_recursive($res, self::parseLine(trim($line)));
        }

        return $res;
    }

    /**
     * @param string $line
     *
     * @return array|array[]|\array[][]|string[]|\string[][]|\string[][][]
     */
    private static function parseLine(string $line): array
    {
        if (strpos($line, "=") === false) {
            return [];
        }

        [$key, $value] = explode("=", $line, 2);

        if ($value == 'true' || $value == 'false') {
            $value = (bool)$value;
        }

        return self::parseKey($key . ".", $value);
    }

    /**
     * @param string $key
     * @param string $val
     *
     * @return array[]|string[]|\string[][]
     */
    private static function parseKey(string $key, string $val): array
    {
        [$keyUp, $keyIn] = explode('.', $key, 2);

        if (!$keyIn) {
            return [$keyUp => $val];
        }

        return [$keyUp => self::parseKey($keyIn, $val)];
    }
}