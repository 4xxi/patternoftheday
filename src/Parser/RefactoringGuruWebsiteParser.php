<?php

namespace Parser;

use Entity\Collection;
use Entity\Pattern;
use Entity\PatternCollection;
use Symfony\Component\DomCrawler\Crawler;

/*
 * TODO: need to rewrite with 'Strategy' pattern.
 * Each parsed website must have each own strategy which is passed to WebsiteParser.
 */
class RefactoringGuruWebsiteParser extends AbstractWebsiteParser
{
    const BASE_URL = 'http://refactoring.guru';

    /** @var string */
    protected $url = self::BASE_URL.'/ru/design-patterns/catalog';

    /** @var string Css-like selector */
    protected $selector = '.pattern-card-container';

    /**
     * @return Collection Collection of the parsed items
     */
    public function getItems() : Collection
    {
        $crawler = parent::parse();

        $collection = new PatternCollection();
        /* @var \DOMElement $item */
        $crawler->each(function (Crawler $item, $i) use ($collection) {
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
