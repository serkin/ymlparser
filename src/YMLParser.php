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
     * @var type 
     */
    private $currency;

    /**
     * Last error code
     * 
     * @var int 
     */
    private $errorCode = 0;


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
        $this->currency = $currency;
    }

    /**
     * Sets error
     * 
     * @param int $errorCode
     * $return void
     */
    private function setError($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * Gets error code
     * 
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Checks for last occured error
     * 
     * @return boolean
     */
    public function hasError()
    {
        return ($this->errorCode === 0) ? false : true;
    }
    
    /**
     * Unsest error
     * 
     * @return void
     */
    private function unsetError()
    {
        $this->errorCode = 0;
    }

    /**
     * Opeтs and creates XML DOM tree
     * 
     * Sets error for YMLParser if cannot open file or xml is invalid
     * 
     * @param string $file Path to file
     * @return boolean
     */
    public function open($file) {

        $returnValue = true;

        if(!file_exists($file)):
            $returnValue = false;
            $this->setError(self::ERROR_FILE_DOESNT_EXIST);            
        endif;

        // TODO Check for valid xml

        return $returnValue;

    }
}