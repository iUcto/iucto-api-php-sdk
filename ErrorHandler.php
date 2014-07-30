<?php
require_once __DIR__ . '/ValidationException.php';
/**
 * @author admin
 */
class ErrorHandler {
    
    public function handleErrors(array $errors) {
        throw new ValidatationException("There are some validation errors for the request", null, null, $errors);
    }
}
