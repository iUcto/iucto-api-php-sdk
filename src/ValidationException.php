<?php

namespace IUcto;

/**
 * Description of IUctoException
 *
 * @author iucto.cz
 */
class ValidationException extends \Exception
{

    private $errors = array();

    public function __construct($message, $code, $previous, array $errors)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
