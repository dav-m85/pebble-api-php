<?php

use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;





// Add the mock subscriber to the client.



class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testDeletePin()
    {
        $history = new History();
        $mock = new Mock([
            "HTTP/1.1 202 OK\r\nContent-Length: 0\r\n\r\n"
        ]);

        $dut = new \PebbleApi\Client();
        $dut->getGuzzleClient()->getEmitter()->attach($history);
        $dut->getGuzzleClient()->getEmitter()->attach($mock);

        $pin = new \PebbleApi\Pin('test-1', array());
        $user= new \PebbleApi\User('user-1');

        $dut->delete($user, $pin);

        $request = $history->getLastRequest();
        // PUT https://timeline-api.getpebble.com/v1/user/pins/reservation-1395203
        // DELETE https://timeline-api.getpebble.com/v1/user/pins/reservation-1395203
        $this->assertSame('https://timeline-api.getpebble.com/v1/user/pins/test-1', $request->getUrl());
        $this->assertArrayHasKey('X-User-Token', $request->getHeaders());
    }
}