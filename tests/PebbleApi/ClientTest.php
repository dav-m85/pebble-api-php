<?php

use GuzzleHttp\Subscriber\History;
use GuzzleHttp\Subscriber\Mock;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    private function assertHasHeader($expectedKey, $expectedValue, $headers)
    {
        $this->assertArrayHasKey($expectedKey, $headers);
        $this->assertContains($expectedValue, $headers[$expectedKey]);
    }

    public function testPutPin()
    {
        $history = new History();
        $mock = new Mock([
            "HTTP/1.1 200 FOUND\r\nContent-Length: 0\r\n\r\n"
        ]);

        $dut = new \PebbleApi\Client();
        $dut->getGuzzleClient()->getEmitter()->attach($history);
        $dut->getGuzzleClient()->getEmitter()->attach($mock);

        $pin = new \PebbleApi\Pin('test-1', array());
        $user= new \PebbleApi\User('user-1');

        $dut->put($user, $pin);

        $request = $history->getLastRequest();
        $headers = $request->getHeaders();
        $this->assertSame('PUT', $request->getMethod());
        $this->assertSame('https://timeline-api.getpebble.com/v1/user/pins/test-1', $request->getUrl());
        $this->assertHasHeader('X-User-Token', 'user-1', $headers);
        $this->assertHasHeader('Content-Type', 'application/json', $headers);
    }

    public function testPutPinInvalidUserToken()
    {
        $history = new History();
        $mock = new Mock([
            "HTTP/1.1 410 GONE\r\nContent-Length: 0\r\n\r\n"
        ]);

        $dut = new \PebbleApi\Client();
        $dut->getGuzzleClient()->getEmitter()->attach($history);
        $dut->getGuzzleClient()->getEmitter()->attach($mock);

        $pin = new \PebbleApi\Pin('test-1', array());
        $user= new \PebbleApi\User('user-1');

        $this->setExpectedException('\PebbleApi\Exception\InvalidUserTokenException');
        $dut->put($user, $pin);
    }

    public function testDeletePin()
    {
        $history = new History();
        $mock = new Mock([
            "HTTP/1.1 200 FOUND\r\nContent-Length: 0\r\n\r\n"
        ]);

        $dut = new \PebbleApi\Client();
        $dut->getGuzzleClient()->getEmitter()->attach($history);
        $dut->getGuzzleClient()->getEmitter()->attach($mock);

        $pin = new \PebbleApi\Pin('test-1', array());
        $user= new \PebbleApi\User('user-1');

        $dut->delete($user, $pin);

        $request = $history->getLastRequest();
        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('https://timeline-api.getpebble.com/v1/user/pins/test-1', $request->getUrl());
        $this->assertArrayHasKey('X-User-Token', $request->getHeaders());
    }
}