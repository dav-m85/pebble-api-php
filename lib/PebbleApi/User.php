<?php

namespace PebbleApi;

class User implements PinRecipientInterface
{
    protected $token;

    public function __construct($userToken)
    {
        $this->token = $userToken;
    }

    public function getHeaders()
    {
        return array("X-User-Token" => $this->token);
    }

    public function getType()
    {
        return 'user';
    }
}