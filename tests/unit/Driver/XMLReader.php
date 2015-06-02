<?php


use YMLParser\YMLParser;
use YMLParser\Driver;

class YMLParser_Driver_XMLReader extends PHPUnit_Framework_TestCase
{
    public function testOpenExistingFile()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());

        $result = $yml->open($filename);

        $this->assertTrue($result);
    }

    public function testRetrivingCategories()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());
        $yml->open($filename);

        $result = $yml->getCategories();

        $this->assertNotEmpty($result);
        $this->assertEquals(9, count($result));
    }

    public function testRetrivingOffers()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());
        $yml->open($filename);

        $result = iterator_to_array($yml->getOffers());

        $this->assertNotEmpty($result);
        $this->assertEquals(5, count($result));
    }

    public function testRetrivingOffersWithAppliedFilter()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());
        $yml->open($filename);

        $result = iterator_to_array($yml->getOffers(function ($el) {
            return !empty($el['vendor']);
        }));

        $this->assertNotEmpty($result);
        $this->assertEquals(4, count($result));
    }

    public function testCountRetrivedOffers()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());
        $yml->open($filename);

        $result = $yml->countOffers();

        $this->assertEquals(5, $result);
    }

    public function testCountRetrivedOffersWithAppliedFilter()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());
        $yml->open($filename);

        $result = $yml->countOffers(function ($el) {
            return !empty($el['vendor']);
        });

        $this->assertEquals(4, $result);
    }

    public function testRetrivedCurrencies()
    {
        $filename = dirname(dirname(__DIR__)).'/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader());
        $yml->open($filename);

        $result = $yml->getCurrencies();

        $this->assertNotEmpty($result);
        $this->assertEquals(3, count($result));
    }
}
