<?php

class JsonPinTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $dut = new \PebbleApi\JsonPin('test', $a = new \DateTime("2015-05-12T13:14:07Z"), array('foo' => 'bar'));
        $data = $dut->getData();

        $this->assertSame(array(
            'id' => "test",
            'time' => "2015-05-12T13:14:07Z",
            'foo' => "bar"
        ), $data);
    }
}
