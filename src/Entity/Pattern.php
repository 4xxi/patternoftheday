<?php

namespace Entity;

class Pattern
{
    /** @var string */
    private $title;

    /** @var string|null */
    private $type;

    /** @var string|null */
    private $shortDescription;

    /** @var string|null */
    private $link;

    /** @var string|null */
    private $imageUrl;

    /** @var string|null */
    private $authorName;

    /** @var string|null */
    private $authorLink;

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string|null $shortDescription
     *
     * @return $this
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     *
     * @return $this
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string|null $imageUrl
     *
     * @return $this
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     *
     * @return $this
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthorLink()
    {
        return $this->authorLink;
    }

    /**
     * @param string|null $authorLink
     *
     * @return $this
     */
    public function setAuthorLink($authorLink)
    {
        $this->authorLink = $authorLink;

        return $this;
    }
}
