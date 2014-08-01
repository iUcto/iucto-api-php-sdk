<?php

class Parser {

    const EMBEDED_KEY = '_embedded';
    const LINKS = '_links';

    public function parse($json) {
        $array = json_decode($json, TRUE);
        if (array_key_exists(self::EMBEDED_KEY, $array)) {
            $this->filter($array);
        }
        return $array;
    }

    function filter(&$input) {
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
