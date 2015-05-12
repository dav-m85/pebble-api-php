<?php

namespace PebbleApi;

interface ActionInterface
{
    const TYPE_OPEN_WATCH_APP = 'openWatchApp';

    /**
     * @return array Array representation of the Pin object.
     */
    public function getData();
}
