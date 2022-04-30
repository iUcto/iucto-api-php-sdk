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

    const DEFAULT_ENDPOINT = 'https://online.iucto.cz/api';

    /**
     * @param $apiKey
     * @param string $endpoint
     * @param string $version
     * @return IUcto
     */
    public static function create($apiKey, $endpoint = self::DEFAULT_ENDPOINT, $version = '1.2')
    {
        $options = [
            RequestOptions::VERIFY => CaBundle::getBundledCaBundlePath(),
            'headers' => [
                'X-Auth-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ],
        ];
        $httpClient = new Client($options);


        $connector = new Connector($httpClient, $version, $endpoint);

        $parser = new Parser();

        $errorHandler = new ErrorHandler();

        return new IUcto($connector, $parser, $errorHandler);
    }
}
