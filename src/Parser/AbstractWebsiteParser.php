<?php

namespace Parser;

use Entity\Collection;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractWebsiteParser
{
    /** @var string */
    protected $url = null;

    /** @var string */
    protected $selector = null;

    /**
     * @return Collection
     */
    abstract public function getItems() : Collection;

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
