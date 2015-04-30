<?php


use YMLParser\YMLParser;
use YMLParser\Driver;

class YMLParser_Driver_SimpleXML extends PHPUnit_Framework_TestCase
{
    public function testOpenExistingFile()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\SimpleXML());

        $result = $yml->open($filename);

        $this->assertTrue($result);
    }

    public function testRetrivingCategories()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($filename);

        $result = $yml->getCategories();

        $this->assertNotEmpty($result);
        $this->assertEquals(9, count($result));
    }

    public function testRetrivingOffers()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($filename);

        $result = iterator_to_array($yml->getOffers());

        $this->assertNotEmpty($result);
        $this->assertEquals(5, count($result));
    }

    public function testRetrivingOffersWithAppliedFilter()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($filename);

        $result = iterator_to_array($yml->getOffers(function ($el) {
            return !empty($el['vendor']);
        }));

        $this->assertNotEmpty($result);
        $this->assertEquals(4, count($result));
    }
}
