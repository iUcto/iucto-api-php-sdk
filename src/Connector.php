<?php

namespace IUcto;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

/**
 * Description of Connector
 *
 * @author iucto.cz
 */
class Connector
{

    const GET = 'GET';
    const PUT = 'PUT';
    const POST = 'POST';
    const DELETE = 'DELETE';

    private $httpClient;

    private $version;
    private $endpoint;

    /**
     * Connector constructor.
     * @param Client $httpClient
     * @param string $version
     * @param string $endpoint
     */
    public function __construct(Client $httpClient, $version, $endpoint)
    {
        $this->httpClient = $httpClient;
        $this->version = $version;
        $this->endpoint = rtrim($endpoint, '/');
    }

    /**
     * Request the server
     *
     * @param string $address
     * @param string $method
     * @param array $params
     * @return string
     * @throws ConnectionException
     */
    public function request($address, $method, $params)
    {
        $options = [
            RequestOptions::HTTP_ERRORS => false,
        ];

        if (!empty($params) && in_array($method, [self::POST, self::PUT])) {
            $options[RequestOptions::JSON] = $params;
        }

        if (!empty($params) && $method == self::GET) {
            $options[RequestOptions::QUERY] = $params;
        }

        $url = $this->endpoint . "/" . $this->version . "/" . $address;

        try {
            $result = $this->httpClient->request($method, $url, $options);

            if ($result->getStatusCode() === 401) {
                throw new ConnectionException('Zkontrolujte prosím, zda je API klíč uveden správně.', $result->getStatusCode());
            }

            $responseBody = $result->getBody()->getContents();

            if ($result->getStatusCode() >= 400) {
                $appended = "Operaci nelze provest. ";
                switch ($result->getStatusCode()) {
                    case 400:
                        if (!empty($responseBody)) {
                            return $responseBody;
                        }
                        $appended .= "Vracený kód 400 muže znamenat tyto možnosti: Komunikace musí probíhat přes protokol HTTPS.|Neplatná verze API, nebo zdroj.|Tělo požadavku je prázdné.|Neplatný JSON formát.|Parametr 'doctype' je povinný.|Chybý povinný parametr.";
                        break;
                    case 401:
                        $appended .= 'Zkontrolujte prosím, zda je API klíč uveden správně.';
                        break;
                    case 403:
                        $appended .= 'Vraceny kod 403 muze znamenat tyto moznosti: Nelze smazat záznam (má na sobě další závsilosti).|Účetní období, nebo období DPH je uzavřeno.';
                        break;
                    case 404:
                        $appended .= 'Záznam nenalezen';
                        break;
                    default:
                        break;
                }
                throw new ConnectionException(sprintf("Error while connecting to %s. Returned code is %s. Body content: %s. Message: %s", $url, $result->getStatusCode(), $responseBody, $appended), $result->getStatusCode());
            }

            return $responseBody;

        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new ConnectionException($ex->getMessage(), $ex->getCode(), $ex);
        }
    }

}
