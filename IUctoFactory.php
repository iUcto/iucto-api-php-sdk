<?php
require_once __DIR__.'/IUcto.php';
require_once __DIR__.'/Curl.php';
require_once __DIR__.'/Connector.php';
require_once __DIR__.'/Parser.php';
require_once __DIR__.'/ErrorHandler.php';
/**
 * @author admin
 */
class IUctoFactory {
    
    const DEFAULT_ENDPOINT = 'https://api.iucto.cz/';
    
    public static function create($apiKey, $endpoint = self::DEFAULT_ENDPOINT, $version = '0.1') {
        $curl = new Curl();
        $curl->setHeader('X-Auth-Key', $apiKey);
        $connector = new Connector($curl, $apiKey, $version, $endpoint);
        
        $parser = new Parser();
        
        $errorHandler = new ErrorHandler();
        
        return new IUcto($connector, $parser, $errorHandler);
    }
}
