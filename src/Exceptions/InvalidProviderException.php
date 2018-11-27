<?php

namespace DariusIII\ItunesApi\Exceptions;

class InvalidProviderException extends ItunesGenericException
{
    private $errorMessage = 'Can\'t find "%s" provider';

    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        $message = sprintf($this->errorMessage, $message);

        parent::__construct($message, $code, $previous);
    }
}
