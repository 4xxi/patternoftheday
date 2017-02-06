<?php

namespace Parser\AbstractParser;

use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractWebsiteParser implements PatternParserInterface
{
    /**
     * Parse page and return selected elements.
     *
     * @param string $url
     * @param string $selector CSS-like selector
     *
     * @return Crawler
     */
    protected function parse(string $url, string $selector) : Crawler
    {
        $html = file_get_contents($url);
        $crawler = new Crawler($html);

        return $crawler->filter($selector);
    }
}
