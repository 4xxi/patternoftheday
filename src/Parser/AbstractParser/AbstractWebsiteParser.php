<?php

namespace Fourxxi\Parser\AbstractParser;

use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractWebsiteParser implements PatternParserInterface
{
    /** @var string */
    protected static $url;

    /** @var string */
    protected static $selector;

    /**
     * @param Crawler $item
     * @return Pattern
     */
    abstract protected function createPattern(Crawler $item): Pattern;

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

    /**
     * @return PatternCollection Collection of the parsed items
     */
    public function getItems(): PatternCollection
    {
        $crawler = $this->parse($this::$url, $this::$selector);

        $collection = new PatternCollection();
        /* @var \DOMElement $itemNode */
        foreach ($crawler->getIterator() as $i => $itemNode) {
            $collection[] = $this->createPattern(new Crawler($itemNode));
        }

        return $collection;
    }
}
