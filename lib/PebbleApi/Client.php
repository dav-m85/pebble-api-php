<?php

namespace PebbleApi;

use GuzzleHttp\Client as GuzzleClient;
use PebbleApi\Exception\ApiException;
use PebbleApi\Exception\InvalidApiKeyException;
use PebbleApi\Exception\InvalidJsonException;
use PebbleApi\Exception\InvalidUserTokenException;
use PebbleApi\Exception\RateLimitExceededException;
use PebbleApi\Exception\ServiceUnavailableException;

class Client
{
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient(array(
            'base_url' => 'https://timeline-api.getpebble.com',
            'defaults' => array(
                'timeout' => 30
            )
        ));
    }

    public function getGuzzleClient()
    {
        return $this->client;
    }

    /**
     * Create or update a pin
     *
     * @param PinRecipientInterface $recipient Either User or SharedTopic
     * @param Pin                   $pin       A Pin to send
     */
    public function put(PinRecipientInterface $recipient, PinInterface $pin)
    {
        $response = $this->client->put(
            $this->buildUrl($recipient, $pin),
            [
                'headers'       => $recipient->getHeaders(),
                'json'          => $pin->getData(),
                'exceptions'    => false
            ]
        );

        return $this->processResponse($response);
    }

    /**
     * Delete a pin
     *
     * @param PinRecipientInterface $recipient
     * @param Pin                   $pin
     */
    public function delete(PinRecipientInterface $recipient, PinInterface $pin)
    {
        $response = $this->client->delete(
            $this->buildUrl($recipient, $pin),
            [
                'headers'       => $recipient->getHeaders(),
                'exceptions'    => false
            ]
        );

        return $this->processResponse($response);
    }

    private function buildUrl(PinRecipientInterface $recipient, PinInterface $pin)
    {
        return sprintf('/v1/%s/pins/%s',
            $recipient->getType(),
            $pin->getId()
        );
    }

    private function processResponse($response)
    {
        $code = $response->getStatusCode();
        if (200 == $code) {
            return true;
        }

        $errorBody = json_decode((string) $response->getBody(), true);
        $errorMessage = ($errorBody && isset($errorBody['errorMessage'])) ? $errorBody['errorMessage'] : null;
        // @todo rework this part
        $errorDetails = ($errorBody && isset($errorBody['errorDetails'][0]['message'])) ? $errorBody['errorDetails'][0]['message'] : null;

        switch ($code) {
            case 400:
                throw new InvalidJsonException($errorDetails);
            case 403:
                throw new InvalidApiKeyException($errorDetails);
            case 410:
                throw new InvalidUserTokenException($errorDetails);
            case 429:
                throw new RateLimitExceededException($errorDetails);
            case 503:
                throw new ServiceUnavailableException($errorDetails);
            default:
                throw new ApiException($errorBody);
        }
    }
}
