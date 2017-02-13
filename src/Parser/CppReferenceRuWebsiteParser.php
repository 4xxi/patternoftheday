<?php

namespace Fourxxi\Parser;

use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Fourxxi\Parser\AbstractParser\AbstractWebsiteParser;
use Symfony\Component\DomCrawler\Crawler;

class CppReferenceRuWebsiteParser extends AbstractWebsiteParser
{
    const BASE_URL = 'http://cpp-reference.ru';

    const URL = self::BASE_URL.'/patterns/catalog/';

    const SELECTOR = 'table > tbody > tr';

    /**
     * @return PatternCollection Collection of the parsed items
     */
    public function getItems(): PatternCollection
    {
        $crawler = $this->parse(self::URL, self::SELECTOR);

        $collection = new PatternCollection();
        /* @var \DOMElement $itemNode */
        foreach ($crawler->getIterator() as $i => $itemNode) {
            if ($i === 0) {
                continue;
            }

            $collection[] = $this->createPattern(new Crawler($itemNode));
        }

        return $collection;
    }

    /**
     * @param Crawler $item
     *
     * @return Pattern
     */
    private function createPattern(Crawler $item): Pattern
    {
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
    }
}
