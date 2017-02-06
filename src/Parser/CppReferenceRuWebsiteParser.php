<?php

namespace Parser;

use Entity\Pattern;
use Entity\PatternCollection;
use Parser\AbstractParser\AbstractWebsiteParser;
use Symfony\Component\DomCrawler\Crawler;

class CppReferenceRuWebsiteParser extends AbstractWebsiteParser
{
    const BASE_URL = 'http://cpp-reference.ru';

    const URL = self::BASE_URL.'/patterns/catalog/';

    const SELECTOR = 'table > tbody > tr';

    /**
     * @return PatternCollection Collection of the parsed items
     */
    public function getItems() : PatternCollection
    {
        $crawler = $this->parse(self::URL, self::SELECTOR);

        $collection = new PatternCollection();
        /* @var \DOMElement $item */
        $crawler->each(function (Crawler $item, $i) use ($collection) {
            // Throw out header row.
            if ($i === 0) {
                return;
            }

            $cells = $item->children();

            $pattern = new Pattern();
            $pattern
                ->setTitle(trim($cells->eq(0)->filter('a')->text()).' / '.trim($cells->eq(1)->text()))
                ->setLink(trim(self::BASE_URL.$cells->eq(0)->filter('a')->attr('href')))
                ->setType(trim($cells->eq(2)->text()))
                ->setShortDescription(trim($cells->eq(3)->text()))
                ->setAuthorName(self::BASE_URL)
                ->setAuthorLink(self::BASE_URL)
            ;

            $collection[] = $pattern;
        });

        return $collection;
    }
}
