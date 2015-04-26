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

    /**
     * Curent curency
     * 
     * @var string 
     */
    private $defaultCurrency;


    const ERROR_FILE_DOESNT_EXIST   = 1;
    const ERROR_INVALID_XML         = 2;

    public function __construct(Driver\DriverInterface $driver) {
        $this->driver = $driver;
    }

    /**
     * Sets default currency
     * 
     * @param string $currency
     * @return void
     */
    public function setDefaultCurrency($currency)
    {
        $this->defaultCurrency = $currency;
    }

    /**
     * Opeтs and creates XML DOM tree
     * 
     * Sets error for YMLParser if cannot open file or xml is invalid
     * 
     * @param string $filename Path to file
     * @throws \Exception Throws exception if file doesn't exist or its size = 0
     * @return boolean
     */
    public function open($filename) {

        if(!file_exists($filename) or filesize($filename) === 0):
            throw new \Exception("File: {$filename} does not exist or empty.");       
        endif;

        return $this->driver->open($file);;

    }
    
    
    public function __call($name, $arguments)
    {
        return $this->driver->$name($arguments);
    }
}