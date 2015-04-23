<?php

use YMLParser\YMLParser;

class YMLParser_YMLParser extends PHPUnit_Framework_TestCase
{
    


    public function testErrorOnFileDoesntExists()
    {
        
        $fakefile = dirname(__DIR__) . '/fixtures/non_existing_file.xml';
        $yml = new YMLParser(new \YMLParser\Driver\XMLReader);
        $result = $yml->open($fakefile);

        $this->assertFalse($result, "File shouldn/t be found");
        $this->assertTrue($yml->hasError());
        $this->assertEquals(YMLParser::ERROR_FILE_DOESNT_EXIST, $yml->getErrorCode());
    }

    public function testErrorOnBrokenFile()
    {
    }


    public function testValidXML()
    {
        $valid_xml_file = dirname(__DIR__) . '/fixtures/valid_xml.xml';
        $yml = new YMLParser(new \YMLParser\Driver\XMLReader);
        $result = $yml->open($valid_xml_file);

        $this->assertTrue($result);
    }
}