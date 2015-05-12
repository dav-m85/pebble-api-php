<?php

namespace PebbleApi;

interface PinInterface
{
    public function getId();

    /**
     * @return array Array representation of the Pin object.
     */
    public function getData();
}
