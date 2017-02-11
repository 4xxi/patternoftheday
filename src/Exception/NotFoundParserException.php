<?php

namespace Fourxxi\Exception;

class NotFoundParserException extends \InvalidArgumentException
{
    /**
     * NotFoundParserException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
