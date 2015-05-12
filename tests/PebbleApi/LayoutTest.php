<?php

class LayoutTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $dut = new \PebbleApi\Layout();
        $dut->setForegroundcolour('blue')
            ->setBackgroundcolour('red')
            ->setLastUpdated(new \DateTime("2015-05-12T13:14:07Z"))
            ->addSection('yay', 'man');

        $data = $dut->getData();
        $this->assertSame(array(
            'foregroundColor' => 'blue',
            'backgroundColor' => 'red',
            'headings' => array(0 => 'yay'),
            'paragraphs' => array (0 => 'man'),
            'lastUpdated' => '2015-05-12T13:14:07Z'
        ), $data);
    }
}