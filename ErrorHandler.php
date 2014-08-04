<?php
require_once __DIR__ . '/ValidationException.php';
/**
 * @author admin
 */
class ErrorHandler {
    
    public function handleErrors(array $errors) {
        throw new ValidationException("There are some validation errors for the request. Errors are stored in error field, kyes correspond input data.", null, null, $errors);
    }
}
