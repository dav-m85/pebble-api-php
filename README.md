[![Build Status](https://travis-ci.org/dav-m85/pebble-api-php.svg)](https://travis-ci.org/dav-m85/pebble-api-php)

## Installation

With composer installed
```bash
php composer.phar require dav-m85/pebble-api-php:dev-master
```

## Usage

```php
$client = new PebbleApi\Client();

// Create (or update) a pin
$pin = new PebbleApi\Pin("reservation-1395203", array(
	"id" => "reservation-1395203",
    "time" => "2014-03-07T09:01:10.229Z",
    "layout" => array(
    	...
    )
));
$user = new PebbleApi\User($userToken);
$client->put($user, $pin);

// Delete a pin
$client->delete($user, $pin);

// Create a pin for all users (shared pin)
$sharedTopic = new PebbleApi\SharedTopic($apiToken, array('baseball', 'giants'));

$client->put($sharedTopic, $pin);

```