<?php

namespace App\Exceptions;

class InvalidCredentialsException extends \Exception
{

    /**
     * @param string $string
     */
    public function __construct(string $string)
    {
        parent::__construct($string);
    }
}