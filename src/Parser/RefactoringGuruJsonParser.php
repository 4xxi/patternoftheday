<?php

namespace Fourxxi\Parser;

use Fourxxi\Entity\Pattern;
use Fourxxi\Entity\PatternCollection;
use Fourxxi\Parser\AbstractParser\AbstractJsonParser;
use Fourxxi\Parser\AbstractParser\PatternParserInterface;

class RefactoringGuruJsonParser extends AbstractJsonParser implements PatternParserInterface
{
    const BASE_URL = 'http://refactoring.guru';

    const URL = self::BASE_URL.'/ru/ajax/structure/all.json';
    const BASE_IMAGE_URL = self::BASE_URL.'/images/patterns/cards/';

    /**
     * @return PatternCollection Collection of the parsed items
     */
    public function getItems(): PatternCollection
    {
        $data = $this->parse(self::URL);

        $collection = new PatternCollection();
        foreach ($data['content'] as $item) {
            if (!$this->isItemAboutPattern($item)) {
                continue;
            }

            $collection[] = $this->createPattern($item);
        }

        return $collection;
    }

    /**
     * @param array $item
     * @return Pattern
     */
    private function createPattern(array $item): Pattern
    {
        $pattern = new Pattern();
        $pattern
            ->setTitle($item['title'].' / '.implode(' / ', $item['aka']))
            ->setShortDescription(strip_tags($item['content_description']))
            ->setType($item['parent']['title'])
            ->setLink(self::BASE_URL.$item['href'])
            ->setImageUrl(self::BASE_IMAGE_URL.$item['name'].'.png')
            ->setAuthorName(self::BASE_URL)
            ->setAuthorLink(self::BASE_URL);

        return $pattern;
    }

    /**
     * @param array $item
     * @return bool
     */
    private function isItemAboutPattern(array $item): bool
    {
        return $item['type'] === 'pattern';
    }
}
