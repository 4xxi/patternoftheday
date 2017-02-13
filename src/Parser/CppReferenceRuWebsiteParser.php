<?php

namespace Fourxxi\Parser;

use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Fourxxi\Parser\AbstractParser\AbstractWebsiteParser;
use Symfony\Component\DomCrawler\Crawler;

class CppReferenceRuWebsiteParser extends AbstractWebsiteParser
{
    const BASE_URL = 'http://cpp-reference.ru';

    /** @var string */
    protected static $url = self::BASE_URL.'/patterns/catalog/';

    /** @var string */
    protected static $selector = 'table > tbody > tr:not(:contains(Оригинальное название))';

    /**
     * @param Crawler $item
     *
     * @return Pattern
     */
    protected function createPattern(Crawler $item): Pattern
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

        return $pattern;
    }
}
