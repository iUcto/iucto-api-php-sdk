<?php
require_once __DIR__ . '/ConnectionException.php';
/**
 * Description of Connector
 *
 * @author admin
 */
class Connector {

    const GET = 'GET';
    const PUT = 'PUT';
    const POST = 'POST';
    const DELETE = 'DELETE';

    private $curl;
    private $apiKey;
    private $version;
    private $endpoint;

    public function __construct(Curl $curl, $apiKey, $version, $endpoint) {
        $this->curl = $curl;
        $this->apiKey = $apiKey;
        $this->version = $version;
        $this->endpoint = rtrim($endpoint, '/');
    }

    public function request($address, $method, $data) {
        $response = null;
        $url = $this->endpoint . "/" . $this->version . "/" . $address;
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
                throw new Exception("Unknown method type ".$method);
        }
        if ($this->curl->curl_error) {
            throw new ConnectionException(sprintf("Error while requesting endpoint. Original message: %s", $this->curl->error_message));
        }
        if ($this->curl->error_code > 205) {
            $prepended = '';
            if ($this->curl->error_code == 401) {
                $prepended = 'Unauthorized. Check you api key. ';
            }
            throw new ConnectionException(sprintf($prepended . "Error while connecting to %s. Returned code is %s. Body content: %s", $url, $this->curl->error_code, $this->curl->response), $this->curl->error_code);
        }
        
        return $response;
    }

}
