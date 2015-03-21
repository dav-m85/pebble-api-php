## Usage

```php
$client = new PebbleApi\Client();

$pin = new PebbleApi\Pin(array(
	'' => ''
));
$user = new PebbleApi\User($userToken);

// Create a pin
$client->putPin($user, $pin);

// Update an existing pin
$pin->layout->shortTitle = 'lets change it';
$client->putPin($user, $pin);

// Delete a pin
$client->deletePin($user, $pin);

```