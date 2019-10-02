<?php

namespace PasargadIranianBank\Pod\Exceptions;

class HttpException extends \RuntimeException
{
	public function getName()
    {
        return 'HttpException';
    }	
}
?>