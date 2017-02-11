<?php

namespace Fourxxi\Exception;

class ParsingException extends \Exception
{
    /**
     * ParsingException constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
