<?php

namespace Fourxxi\Parser\AbstractParser;

use Fourxxi\Entity\PatternCollection;

interface PatternParserInterface
{
    public function getItems(): PatternCollection;
}
