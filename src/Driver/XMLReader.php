<?php

namespace YMLParser\Driver;

class XMLReader implements DriverInterface
{

    public function getCategories() {
        return [];
    }

    public function getCurrencies() {
        return [];
    }

    public function getOffers(\Closure $filter = null) {
        return [];
    }

    public function create($xml) {
        
    }

    public function countOffers(\Closure $filter) {
        return 0;
    }
}