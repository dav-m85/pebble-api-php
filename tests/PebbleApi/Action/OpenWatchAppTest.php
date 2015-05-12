<?php

class OpenWatchAppTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $dut = new \PebbleApi\Action\OpenWatchApp('title', 12);
        $data = $dut->getData();
        $this->assertSame(array(
            'type' => \PebbleApi\ActionInterface::TYPE_OPEN_WATCH_APP,
            'title'=> 'title',
            'launchcode' => 12
        ), $data);
    }
}