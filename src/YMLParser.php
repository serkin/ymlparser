<?php

namespace YMLParser;


class YMLParser
{
    /**
     * Driver for parsing xml
     * 
     * @var Driver\DriverInterface 
     */
    private $driver;

    public function __construct($xml, Driver\DriverInterface $driver) {
        $this->driver = $driver;
    }

    public function setDefaultCurrency($currency)
    {}
}