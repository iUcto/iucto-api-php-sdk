<?php

namespace IUcto;

/**
 * @author iucto.cz
 */
class ErrorHandler
{

    /**
     * @param array $errors
     * @throws ValidationException
     */
    public function handleErrors(array $errors)
    {
        throw new ValidationException("There are some validation errors for the request. Errors are stored in error field, kyes correspond input data.", null, null, $errors);
    }
}
