<?php

namespace Parser;

use Entity\PatternCollection;

interface PatternParserInterface
{
    public function getItems(): PatternCollection;
}
