<?php

namespace IUcto;

class Parser
{

    const EMBEDED_KEY = '_embedded';
    const LINKS = '_links';
    const PAGE_COUNT = 'pageCount';
    const PAGE_SIZE = 'pageSize';
    const PAGE = 'page';

    public function parse($json)
    {
        if (!$json) {
            return null;
        }
        $array = json_decode($json, TRUE);
        if (!$array) {
            return null;
        }
        $result = $array;
        if (array_key_exists(self::EMBEDED_KEY, $array)) {
            $this->filter($result);
            $result = $array[self::EMBEDED_KEY];

            if (isset($array[self::PAGE_COUNT])) {
                $result[self::PAGE_COUNT] = $array[self::PAGE_COUNT];
            }
            if (isset($array[self::PAGE_SIZE])) {
                $result[self::PAGE_SIZE] = $array[self::PAGE_SIZE];
            }
            if (isset($array[self::PAGE])) {
                $result[self::PAGE] = $array[self::PAGE];
            }
            return $result;
        }

        return $result;
    }

    function filter(&$input)
    {
        if (array_key_exists(self::LINKS, $input)) {
            unset($input[self::LINKS]);
        }
        foreach ($input as &$value) {
            if (is_array($value)) {
                $this->filter($value);
            }
        }
    }

}
