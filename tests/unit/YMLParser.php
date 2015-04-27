<?php

use YMLParser\YMLParser;
use YMLParser\Driver;

class YMLParser_YMLParser extends PHPUnit_Framework_TestCase
{
    


    /**
     * @expectedException \Exception
     */
    public function testExceptionOnFileDoesntExists()
    {
        
        $fakefile = dirname(__DIR__) . '/fixtures/non_existing_file.xml';
        $yml = new YMLParser(new Driver\XMLReader);
        $yml->open($fakefile);
    }
    

    public function testOpenExistingFile()
    {

        $fakefile = dirname(__DIR__) . '/fixtures/valid_xml.xml';
        $yml = new YMLParser(new Driver\XMLReader);

        $result = $yml->open($fakefile);
        
        $this->assertTrue($result);
    }
}