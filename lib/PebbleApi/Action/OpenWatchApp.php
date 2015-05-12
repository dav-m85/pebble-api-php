<?php

namespace PebbleApi\Action;

class OpenWatchApp implements \PebbleApi\ActionInterface
{
    /** @var  string The name of the action that appears on the watch. */
    private $title;

    /** @var int */
    private $launchCode;

    /**
     * @param string $title      The name of the action that appears on the watch.
     * @param int    $launchCode
     */
    public function __construct($title, $launchCode)
    {
        $this->title = $title;
        $this->launchCode = $launchCode;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array_filter(['type' =>  'openWatchApp', 'title' => $this->title, 'launchcode' => $this->launchCode]);
    }
}
