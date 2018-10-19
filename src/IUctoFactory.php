<?php

namespace IUcto;

use Composer\CaBundle\CaBundle;

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
     * @throws \ErrorException
     */
    public static function create($apiKey, $endpoint = self::DEFAULT_ENDPOINT, $version = '1.0')
    {
        $curl = new Curl();
        if (strpos($endpoint, 'https') === 0) {
            $curl->setOpt(CURLOPT_CAINFO, CaBundle::getBundledCaBundlePath());
        }
        $curl->setHeader('X-Auth-Key', $apiKey);
        $curl->setHeader('Content-Type', 'application/json');
        $connector = new Connector($curl, $apiKey, $version, $endpoint);

        $parser = new Parser();

        $errorHandler = new ErrorHandler();

        return new IUcto($connector, $parser, $errorHandler);
    }
}
