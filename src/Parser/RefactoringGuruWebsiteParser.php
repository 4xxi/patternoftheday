<?php

namespace Parser;

use Entity\Pattern;
use Entity\PatternCollection;
use Parser\AbstractParser\AbstractWebsiteParser;
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
        /* @var \DOMElement $item */
        $crawler->each(function(Crawler $item) use ($collection) {
            $pattern = new Pattern();
            $pattern
                ->setLink(self::BASE_URL.$item->attr('href'))
                ->setImageUrl(self::BASE_URL.$item->filter('img')->attr('href'))
                ->setTitle(trim($item->filter('.pattern-name')->text()).' / '.trim($item->filter('.pattern-aka')->text()))
                ->setShortDescription('')
                ->setAuthorName(self::BASE_URL)
                ->setAuthorLink(self::BASE_URL)
            ;

            $collection[] = $pattern;
        });

        return $collection;
    }
}
