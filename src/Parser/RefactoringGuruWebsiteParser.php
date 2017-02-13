<?php

namespace Fourxxi\Parser;

use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Fourxxi\Parser\AbstractParser\AbstractWebsiteParser;
use Symfony\Component\DomCrawler\Crawler;

class RefactoringGuruWebsiteParser extends AbstractWebsiteParser
{
    const BASE_URL = 'http://refactoring.guru';

    const URL = self::BASE_URL.'/ru/design-patterns/catalog';

    const SELECTOR = '.pattern-card-container';

    /**
     * @return PatternCollection Collection of the parsed items
     */
    public function getItems() : PatternCollection
    {
        $crawler = $this->parse(self::URL, self::SELECTOR);

        $collection = new PatternCollection();

        /* @var \DOMElement $itemNode */
        foreach ($crawler->getIterator() as $i => $itemNode) {
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
        $pattern = new Pattern();
        $pattern
            ->setLink(self::BASE_URL.$item->attr('href'))
            ->setImageUrl(self::BASE_URL.$item->filter('img')->attr('href'))
            ->setTitle(trim($item->filter('.pattern-name')->text()).' / '.trim($item->filter('.pattern-aka')->text()))
            ->setShortDescription('')
            ->setAuthorName(self::BASE_URL)
            ->setAuthorLink(self::BASE_URL)
        ;
    }
}
