<?php

class PinTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $layout = $this->prophesize('PebbleApi\LayoutInterface');
        $layout->getData()->willReturn(array())->shouldBeCalled();

        $dut = new \PebbleApi\Pin('test', $a = new \DateTime("2015-05-12T13:14:07Z"), $layout->reveal());
        $dut->setDuration(120);
        $data = $dut->getData();

        $this->assertSame(array(
            'id' => "test",
            'time' => "2015-05-12T13:14:07Z",
            'duration' => 120
        ), $data);
    }
}
