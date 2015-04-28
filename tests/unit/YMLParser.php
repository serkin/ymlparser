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

        $filename = dirname(__DIR__) . '/fixtures/non_existing_file.xml';
        $yml = new YMLParser(new Driver\XMLReader);
        $yml->open($filename);
    }



}