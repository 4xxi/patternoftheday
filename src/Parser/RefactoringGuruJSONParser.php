<?php

namespace Parser;

use Entity\Collection;
use Entity\Pattern;
use Entity\PatternCollection;

class RefactoringGuruJSONParser
{
    const BASE_URL = 'http://refactoring.guru';

    /** @var string */
    protected $url = self::BASE_URL.'/ajax/content/static.json';

    /**
     * @return Collection Collection of the parsed items
     */
    public function getItems() : Collection
    {
        $data = json_decode(file_get_contents($this->url), true);

        $collection = new PatternCollection();
        foreach ($data['content'] as $item) {
            if ($item['locale'] !== 'ru' || $item['type'] !== 'pattern') {
                continue;
            }

            $pattern = new Pattern();
            $pattern
                ->setTitle($item['title'].' / '.implode(',', $item['aka']))
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
