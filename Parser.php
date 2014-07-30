<?php

class Parser {
    
    public function parse($json) {
        return json_decode($json, TRUE);
    }
    
}
