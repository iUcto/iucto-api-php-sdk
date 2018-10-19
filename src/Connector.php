<?php

namespace IUcto;

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

    private $curl;
    private $apiKey;
    private $version;
    private $endpoint;

    public function __construct(Curl $curl, $apiKey, $version, $endpoint)
    {
        $this->curl = $curl;
        $this->apiKey = $apiKey;
        $this->version = $version;
        $this->endpoint = rtrim($endpoint, '/');
    }

    /**
     * Request the server
     *
     * @param string $address
     * @param string $method
     * @param mixed[] $data
     * @return mixed[]
     * @throws ConnectionException
     */
    public function request($address, $method, $data)
    {
        $response = null;
        $url = $this->endpoint . "/" . $this->version . "/" . $address;
        try {
            switch ($method) {
                case self::GET:
                    $response = $this->curl->get($url, $data);
                    break;
                case self::POST:
                    $response = $this->curl->post($url, $data);
                    break;
                case self::PUT:
                    $response = $this->curl->put($url, $data);
                    break;
                case self::DELETE:
                    $response = $this->curl->delete($url, $data);
                    break;
                default:
                    throw new \ErrorException("Unknown method type " . $method);
            }
        } catch (\ErrorException $ex) {
            throw new ConnectionException('Error while creating connection', $ex->getCode(), $ex);
        }
        if ($this->curl->curl_error) {
            throw new ConnectionException(sprintf("Error while requesting endpoint. Original message: %s", $this->curl->error_message));
        }
        if ($this->curl->error_code > 205 && $this->curl->response === '') {
            $appended = "Operaci nelze provest. ";
            switch ($this->curl->error_code) {
                case 400:
                    $appended .= "Vracený kód 400 muže znamenat tyto možnosti: Komunikace musí probíhat přes protokol HTTPS.|Neplatná verze API, nebo zdroj.|Tělo požadavku je prázdné.|Neplatný JSON formát.|Parametr 'doctype' je povinný.|Parametr 'doctype' není platný.|Parametr 'date' je povinný.|Parametr 'date' není platný.";
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
                    $appended .= $this->curl->error_message;
            }

            throw new ConnectionException(sprintf("Error while connecting to %s. Returned code is %s. Body content: %s. Message: %s", $url, $this->curl->error_code, $this->curl->response, $appended), $this->curl->error_code);
        }

        return $response;
    }

}
