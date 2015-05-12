<?php

namespace PebbleApi;

/**
 * The layout object is used to describe any message shown in a customizable layout. This includes a pin in
 * the timeline, a notification and also reminders. Developers can choose between different layout types and
 * customize them with attributes.
 */
class Layout implements LayoutInterface
{
    /** @var string Six-digit color hexadecimal string describing the foreground text color,
     * or case-insensitive SDK constant name such as "mintgreen". */
    private $foregroundcolour;

    /** @var string Same as foregroundColor, except applies to the background color. */
    private $backgroundcolour;

    /** @var string[] List of section headings in this layout. */
    private $headings = array();

    /** @var string[] List of paragraphs in this layout. Must equal the number of headings. */
    private $paragraphs = array();

    /** @var \DateTime Timestamp of when the pin’s data (e.g: weather forecast or sports score) was last updated. */
    private $lastUpdated;

    /**
     * @param  string $foregroundcolour
     * @return Layout
     */
    public function setForegroundcolour($foregroundcolour)
    {
        $this->foregroundcolour = $foregroundcolour;

        return $this;
    }

    /**
     * @param  string $backgroundcolour
     * @return Layout
     */
    public function setBackgroundcolour($backgroundcolour)
    {
        $this->backgroundcolour = $backgroundcolour;

        return $this;
    }

    /**
     * @param  \DateTime $lastUpdated
     * @return Layout
     */
    public function setLastUpdated(\DateTime $lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * @param string $heading
     * @param string $paragraph
     */
    public function addSection($heading, $paragraph)
    {
        array_push($this->headings, $heading);
        array_push($this->paragraphs, $paragraph);
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array_filter([
            'foregroundColor' => $this->foregroundcolour,
            'backgroundColor' => $this->backgroundcolour,
            'headings' => empty($this->headings) ? null : $this->headings,
            'paragraphs' => empty($this->paragraphs) ? null : $this->paragraphs,
            'lastUpdated' => $this->lastUpdated ? $this->lastUpdated->format('Y-m-d\TH:i:s\Z') : null
        ]);
    }
}
