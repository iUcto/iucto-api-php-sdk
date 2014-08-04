<?php
namespace IUcto;

require_once __DIR__.'/IUcto.php';
require_once __DIR__.'/Curl.php';
require_once __DIR__.'/Connector.php';
require_once __DIR__.'/Parser.php';
require_once __DIR__.'/ErrorHandler.php';

require_once __DIR__ . '/Dto/DocumentOverview.php';
require_once __DIR__ . '/Dto/DocumentItem.php';
require_once __DIR__ . '/Dto/DocumentDetail.php';
require_once __DIR__ . '/Dto/Department.php';
require_once __DIR__ . '/Dto/CustomerOverview.php';
require_once __DIR__ . '/Dto/Customer.php';
require_once __DIR__ . '/Dto/Contract.php';
require_once __DIR__ . '/Dto/BankAccount.php';
require_once __DIR__ . '/Dto/BankAccountOverview.php';
require_once __DIR__ . '/Dto/BankAccountList.php';
require_once __DIR__ . '/Dto/Address.php';

require_once __DIR__ . '/Command/SaveCustomer.php';
require_once __DIR__ . '/Command/SaveDocument.php';

require_once __DIR__ . '/Utils.php';


/**
 * @author admin
 */
class IUctoFactory {
    
    const DEFAULT_ENDPOINT = 'http://api.gsmobile-novydesign.dev2.datesoft.cz/'; //'https://api.iucto.cz/';
    
    public static function create($apiKey, $endpoint = self::DEFAULT_ENDPOINT, $version = '0.1') {
        $curl = new Curl();
        $curl->setHeader('X-Auth-Key', $apiKey);
        $curl->setHeader('Content-Type', 'application/json');
        $connector = new Connector($curl, $apiKey, $version, $endpoint);
        
        $parser = new Parser();
        
        $errorHandler = new ErrorHandler();
        
        return new IUcto($connector, $parser, $errorHandler);
    }
}
