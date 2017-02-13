<?php

namespace Fourxxi\Parser;

use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Fourxxi\Parser\AbstractParser\AbstractWebsiteParser;
use Symfony\Component\DomCrawler\Crawler;

class RefactoringGuruWebsiteParser extends AbstractWebsiteParser
{
    const BASE_URL = 'http://refactoring.guru';

    /** @var string */
    protected static $url = self::BASE_URL.'/ru/design-patterns/catalog';

    /** @var string */
    protected static $selector = '.pattern-card-container';

    /**
     * @param Crawler $item
     *
     * @return Pattern
     */
    protected function createPattern(Crawler $item): Pattern
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

        return $pattern;
    }
}
