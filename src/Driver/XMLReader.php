<?php

namespace YMLParser\Driver;

class XMLReader implements DriverInterface
{

    private $xml;

    public function getCategories() {
        return [];
    }

    public function getCurrencies() {
        return [];
    }

    public function getOffers(\Closure $filter = null) {
        return [];
    }

    public function open($filename) {

        $this->xml = new \XMLReader();
        return $this->xml->open($filename);
    }

    public function countOffers(\Closure $filter) {
        return 0;
    }

    public function isValid() {
        return $this->xml->isValid();
    }
}