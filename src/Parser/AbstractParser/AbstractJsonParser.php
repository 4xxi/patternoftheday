<?php

namespace Parser\AbstractParser;

abstract class AbstractJsonParser implements PatternParserInterface
{
    /**
     * Parse page and return selected elements.
     *
     * @param string $url
     *
     * @return array
     */
    protected function parse(string $url) : array
    {
        return json_decode(file_get_contents($url), true);
    }
}
