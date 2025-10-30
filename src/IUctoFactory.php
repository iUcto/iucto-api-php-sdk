<?php

namespace IUcto;

use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * @author iucto.cz
 */
class IUctoFactory
{

    /** @var string  */
    const DEFAULT_ENDPOINT = 'https://online.iucto.cz/api';


    public static function create(string $apiKey, string $endpoint = self::DEFAULT_ENDPOINT, string $version = '1.2', array $clientConfig = []) : IUcto
    {
        $config = $clientConfig + [
            RequestOptions::VERIFY => CaBundle::getBundledCaBundlePath(),
            'headers' => [
                'X-Auth-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ],
        ];
        $httpClient = new Client($config);


        $connector = new Connector($httpClient, $version, $endpoint);

        $parser = new Parser();

        $errorHandler = new ErrorHandler();

        return new IUcto($connector, $parser, $errorHandler);
    }
}
