<?php

namespace HeroSeguros\HeroLaravelLibrary\Exceptions;

class HeroLibException extends \Exception
{
    public function __construct(string $message, int $code = 0, \Throwable $previous = null)
    {
        $message = "HeroLibException: {$message}";
        parent::__construct($message, $code, $previous);
    }
}