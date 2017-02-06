<?php

namespace Parser;

use Entity\Pattern;
use Entity\PatternCollection;
use Parser\AbstractParser\AbstractJsonParser;
use Parser\AbstractParser\PatternParserInterface;

class RefactoringGuruJsonParser extends AbstractJsonParser implements PatternParserInterface
{
    const BASE_URL = 'http://refactoring.guru';

    const URL = self::BASE_URL.'/ajax/content/static.json';

    /**
     * @return PatternCollection Collection of the parsed items
     */
    public function getItems() : PatternCollection
    {
        $data = $this->parse(self::URL);

        $collection = new PatternCollection();
        foreach ($data['content'] as $item) {
            if ($item['locale'] !== 'ru' || $item['type'] !== 'pattern') {
                continue;
            }

            $pattern = new Pattern();
            $pattern
                ->setTitle($item['title'].' / '.implode(' / ', $item['aka']))
                ->setShortDescription($item['description'])
                ->setType($item['parent']['title'])
                ->setLink(self::BASE_URL.$item['href'])
                ->setImageUrl(self::BASE_URL.'/images/patterns/cards/'.$item['name'].'.png')
                ->setAuthorName(self::BASE_URL)
                ->setAuthorLink(self::BASE_URL);

            $collection[] = $pattern;
        }

        return $collection;
    }
}
