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
     * @throws ServerException
     * @throws BadRequestException
     * @throws ForbiddenException
     * @throws NotFoundException
     * @throws PaymentRequiredException
     * @throws UnautorizedException
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

            $responseBody = $result->getBody()->__toString();

            if ($result->getStatusCode() === 503) {
                throw new MaintenanceException('Na serveru probíhá údržba.', $result->getStatusCode());
            }

            if ($result->getStatusCode() >= 500) {
                throw new ServerException('Nastala neočekávaná chyba na serveru.', $result->getStatusCode());
            }

            if ($result->getStatusCode() >= 400) {
                switch ($result->getStatusCode()) {
                    case 400:
                        throw new BadRequestException('Neplatný požadavek.', $result->getStatusCode(), null, $responseBody);
                        break;
                    case 401:
                        throw new UnautorizedException('Zkontrolujte prosím, zda je API klíč uveden správně.', $result->getStatusCode());
                        break;
                    case 402:
                        throw new PaymentRequiredException($responseBody, $result->getStatusCode());
                        break;
                    case 403:
                        throw new ForbiddenException('Nelze editovat záznam, existují další závislosti, je uzavřeno účetní období, nebo období DPH.', $result->getStatusCode());
                        break;
                    case 404:
                        throw new NotFoundException('Záznam nenalezen', $result->getStatusCode());
                        break;
                    default:
                        throw new ConnectionException('Neznámá chyby v požadavku na server.', $result->getStatusCode());
                        break;
                }
            } else {
                return $responseBody;
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new ConnectionException($ex->getMessage(), $ex->getCode(), $ex);
        } catch (\RuntimeException $ex){
            throw new ConnectionException('Chyba při čtení odpovědi.', $ex->getCode(), $ex);
        }
    }

}
