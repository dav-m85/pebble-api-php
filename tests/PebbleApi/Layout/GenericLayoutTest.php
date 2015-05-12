<?php

class GenericLayoutTest extends \PHPUnit_Framework_TestCase
{
    public function testGetData()
    {
        $dut = new \PebbleApi\Layout\GenericLayout();
        $dut->setTitle('title')
            ->setSubtitle('subtitle')
            ->setTinyicon('tinyicon')
            ->setBody('body');

        $data = $dut->getData();
        $this->assertSame(array(
            'type' => \PebbleApi\LayoutInterface::TYPE_GENERIC_PIN,
            'title' => 'title',
            'subtitle' => 'subtitle',
            'body' => 'body',
            'tinyIcon' => 'tinyicon'
        ), $data);
    }
}
