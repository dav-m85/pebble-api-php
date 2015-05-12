<?php

namespace PebbleApi;

class SharedTopic implements PinRecipientInterface
{
    private $token;
    private $topics;

    public function __construct($apiToken, array $topics)
    {
        $this->token = $apiToken;
        $this->topics = $topics;
    }

    public function getHeaders()
    {
        return array(
            "X-API-Key" => $this->token,
            "X-Pin-Topics" => implode(',', $this->topics)
        );
    }

    public function getType()
    {
        return 'shared';
    }
}
