[![Build Status](https://travis-ci.org/dav-m85/pebble-api-php.svg)](https://travis-ci.org/dav-m85/pebble-api-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dav-m85/pebble-api-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dav-m85/pebble-api-php/?branch=master)

**[WIP] This library is still under development**. Feel free to contribute !

Library to interact with Pebble Timeline API.

## Why should I use it ?
Because you love when ...
* It's tested code
* It can be installed with composer
* It follows semver
* It's already used in production

## Installation

With composer installed
```bash
php composer.phar require dav-m85/pebble-api-php:dev-master
```

## Usage

```php
// Define a pin with an Array
$pin = new PebbleApi\Pin("reservation-1395203", new \DateTime("2014-03-07T09:01:10.229Z"), array(
    "layout" => array(
    	...
    )
));

// Or using object oriented approach (still work in progress)
$layout = new PebbleApi\Layout\GenericLayout();
$layout->setForegroundColor(PebbleApi\LayoutInterface::COLOR_BLUE);
$pin = new PebbleApi\Pin("reservation-1395203", new \DateTime("2014-03-07T09:01:10.229Z"), $layout);

// Then spawn a client
$client = new PebbleApi\Client();

// Create (or update) a pin
$user = new PebbleApi\User($userToken);
$client->put($user, $pin);

// Delete a pin
$client->delete($user, $pin);

// Create a pin for all users (shared pin)
$sharedTopic = new PebbleApi\SharedTopic($apiToken, array('baseball', 'giants'));

$client->put($sharedTopic, $pin);

```
