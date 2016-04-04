<?php

use YMLParser\YMLParser;
use YMLParser\Driver;

class YMLParser_Driver_SimpleXML extends PHPUnit_Framework_TestCase {

    public $fixtureFileName;

    public function setUp() {
        $this->fixtureFileName = dirname(dirname(__DIR__)) . '/fixtures/valid_xml.xml';
    }

    public function testOpenExistingFile() {

        $yml = new YMLParser(new Driver\SimpleXML());

        $result = $yml->open($this->fixtureFileName);

        $this->assertTrue($result);
    }

    public function testRetrivingCategories() {

        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($this->fixtureFileName);

        $result = $yml->getCategories();


        $this->assertTrue($result[0] instanceof \YMLParser\Node\Category);
        $this->assertEquals($result[0]->getChildren(), []);
        $this->assertTrue($result[0]->hasParentCategory());
        $this->assertTrue($result[0]->getParentCategory() instanceof \YMLParser\Node\Category);

        $this->assertNotEmpty($result);
        $this->assertEquals(9, count($result));
        $this->assertTrue($result[0] instanceof \YMLParser\Node\Category);
    }

    public function testRetrivingOffers() {

        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($this->fixtureFileName);

        $result = iterator_to_array($yml->getOffers());

        $this->assertNotEmpty($result);
        $this->assertEquals(5, count($result));
        $this->assertEquals(3, count($result[0]['pictures']));
        $this->assertTrue($result[0] instanceof \YMLParser\Node\Offer);
        $this->assertTrue(is_numeric($result[0]->getPrice()));
    }

    public function testRetrivingOffersWithAppliedFilter() {

        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($this->fixtureFileName);

        $result = iterator_to_array($yml->getOffers(function ($el) {
                    return !empty($el['vendor']);
                }));

        $this->assertNotEmpty($result);
        $this->assertEquals(4, count($result));
    }

    public function testCountRetrivedOffers() {

        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($this->fixtureFileName);

        $result = $yml->countOffers();

        $this->assertEquals(5, $result);
    }

    public function testCountRetrivedOffersWithAppliedFilter() {

        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($this->fixtureFileName);

        $result = $yml->countOffers(function ($el) {
            return !empty($el['vendor']);
        });

        $this->assertEquals(4, $result);
    }

    public function testRetrivedCurrencies() {

        $yml = new YMLParser(new Driver\SimpleXML());
        $yml->open($this->fixtureFileName);

        $result = $yml->getCurrencies();

        $this->assertNotEmpty($result);
        $this->assertEquals(3, count($result));
        $this->assertTrue($result[0] instanceof \YMLParser\Node\Currency);
    }

}
