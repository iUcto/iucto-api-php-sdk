<?php

namespace IUcto;

use Throwable;

/**
 * Description of BadRequestException
 *
 * @author iucto.cz
 */
class BadRequestException extends ConnectionException
{
    protected $responseData;

    public function __construct($message = "", $code = 0, Throwable $previous = null, string $responseData = null)
    {
        $this->responseData = $responseData;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getResponseData(): string
    {
        return $this->responseData;
    }


}
