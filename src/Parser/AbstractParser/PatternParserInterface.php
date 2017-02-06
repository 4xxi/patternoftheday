<?php

namespace Parser\AbstractParser;

use Entity\PatternCollection;

interface PatternParserInterface
{
    public function getItems(): PatternCollection;
}
