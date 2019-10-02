<?php
namespace PasargadIranianBank\Pod\Exceptions;

class PodException extends \RuntimeException
{
    public function __construct($message, $code, $responseData = null)
    {
        parent::__construct($message . ' Error Code: ' . $code, $code, $responseData);
    }
}