<?php

namespace Parser;

use Entity\PatternCollection;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractWebsiteParser implements PatternParserInterface
{
    /** @var string */
    protected $url = null;

    /** @var string */
    protected $selector = null;

    /**
     * @return PatternCollection
     */
    abstract public function getItems() : PatternCollection;

    /**
     * Parse page and return selected elements.
     *
     * @return Crawler
     */
    public function parse() : Crawler
    {
        $html = file_get_contents($this->url);
        $crawler = new Crawler($html);

        return $crawler->filter($this->selector);
    }
}
