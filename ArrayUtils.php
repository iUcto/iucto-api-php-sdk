<?php

/**
 * Description of ArrayUtils
 *
 * @author odehnal@iprogress.cz
 */
class ArrayUtils {

    public static function getValueOrNull(array $array, $key) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
        echo $key.'<br>';
        return null;
    }

}
