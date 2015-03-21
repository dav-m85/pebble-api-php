<?php

namespace PebbleApi;

use GuzzleHttp\Client as GuzzleClient;
use PebbleApi\Exception\ApiException;

class Client
{
	protected $client;

	public function __construct() 
	{
		$this->client = new GuzzleClient(['base_url' => 'https://timeline-api.getpebble.com']);
	}

	/**
	 * Create or update a pin
	 *
	 * @param PinRecipientInterface $recipient Either User or SharedTopic
	 * @param Pin $pin A Pin to send
	 */
	public function put(PinRecipientInterface $recipient, Pin $pin)
	{
		$url = sprintf('/v1/%s/pins/%s',
			$recipient->getType(),
			$pin->getId()
		);
		$headers = array_merge(
			array('Content-Type' => 'application/json'),
			$recipient->getHeaders()
		);
		$response = $this->client->put($url, [
			'headers'       => $headers,
			'body'          => $pin->toJson()
		]);
		switch($response->getStatusCode()){
			case 200:
				return true;
			default:
				throw new ApiException($response->getBody()->__toString());
		}
	}

	public function delete(PinRecipientInterface $recipient, Pin $pin)
	{
		$url = sprintf('/v1/%s/pins/%s',
			$recipient->getType(),
			$pin->getId()
		);
		$headers = array_merge(
			array('Content-Type' => 'application/json'),
			$recipient->getHeaders()
		);
		$response = $this->client->delete($url, [
			'headers'       => $headers
		]);
	}
}