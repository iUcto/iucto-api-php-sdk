<?php

namespace IUcto;

use DateTime;

/**
 * Description of ArrayUtils
 *
 * @author iucto.cz
 */
class Utils
{
    public const TYPE_INT = 'int';
    public const TYPE_FLOAT = 'float';
    public const TYPE_BOOL = 'bool';
    public const TYPE_STRING = 'string';

    public static function getTypedValueOrNull(array $array, $key, $type = self::TYPE_STRING)
    {
        if (!array_key_exists($key, $array)) {
            return null;
        }
        if ($type === self::TYPE_INT) {
            return (int)$array[$key];
        }
        if ($type === self::TYPE_FLOAT) {
            return (float)$array[$key];
        }
        if ($type === self::TYPE_BOOL) {
            return (bool)$array[$key];
        }
        return $array[$key];
    }

    public static function getValueOrNull(array $array, $key)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        return null;
    }

    /**
     * @param $input
     * @return bool|DateTime
     */
    public static function getDateTimeFrom($input)
    {
        if ($input instanceof DateTime) {
            return $input;
        }
        return DateTime::createFromFormat("Y-m-d", $input);
    }

    /**
     * @param $input
     * @return string
     */
    public static function getTimestampFrom($input)
    {
        if ($input instanceof DateTime) {
            return $input->format("U");
        }
        return $input;
    }

}
