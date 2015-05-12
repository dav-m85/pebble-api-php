<?php

namespace PebbleApi\Layout;

use PebbleApi\Layout;

// mandatory: title, tinyIcon
class GenericLayout extends Layout
{
    /** @var string The title of the pin when viewed. */
    private $title;

    /** @var string Shorter subtitle for details. */
    private $subtitle;

    /** @var string The body text of the pin. */
    private $body;

    /** @var string URI of the pin's tiny icon. */
    private $tinyicon;

    /**
     * @param  string        $title
     * @return GenericLayout
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  string        $subtitle
     * @return GenericLayout
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @param  string        $body
     * @return GenericLayout
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @param  string        $tinyicon
     * @return GenericLayout
     */
    public function setTinyicon($tinyicon)
    {
        $this->tinyicon = $tinyicon;

        return $this;
    }

    public function getData()
    {
        return array_filter(array_merge(
            [
                'type' => self::TYPE_GENERIC_PIN,
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'body' => $this->body,
                'tinyIcon' => $this->tinyicon
            ],
            parent::getData()
        ));
    }
}
