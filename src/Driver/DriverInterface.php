<?php

namespace YMLParser\Driver;

interface DriverInterface
{

    /**
     * Creates XML Parser according with driver
     * 
     * @param string $xml Valid xml string
     */
    public function create($xml);
    /**
     * @return array
     */
    public function getCategories();
    
    public function getOffers(\Closure $filter = null);

    public function getCurrencies();
    
    public function countOffers(\Closure $filter);
}