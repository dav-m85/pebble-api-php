## Usage

```php
$client = new PebbleApi\Client();

// Create (or update) a pin
$pin = new PebbleApi\Pin(array(
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