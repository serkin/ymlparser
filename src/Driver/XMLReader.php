<?php

namespace YMLParser\Driver;

class XMLReader implements DriverInterface
{

    private $xml;
    private $filename;

    public function getCategories()
    {

        $out = [];
        $this->moveToStart();
        $xml = $this->xml;

        while ($xml->read()) {
            if ($xml->nodeType==\XMLReader::ELEMENT && $xml->name == 'categories') {
                while ($xml->read() && $xml->name != 'categories') {
                    if ($xml->nodeType == \XMLReader::ELEMENT) {
                        
                        $arr = [];

                        if ($xml->hasAttributes):

                            while ($xml->moveToNextAttribute()):
                                $arr[strtolower($xml->name)] = $xml->value;
                            endwhile;
                        endif;

                        $xml->read();
                        $arr['value'] = $xml->value;
                        $out[] = new \YMLParser\Node\Category($arr);

                        unset($arr);

                    }
                }
            }
        }

        return $out;
    }

    public function getCurrencies()
    {
        return [];
    }

    public function getOffers(\Closure $filter = null)
    {

        $this->moveToStart();
        $xml = $this->xml;
        
        while ($xml->read()) {
            if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'offers') {
                while ($xml->read() && $xml->name != 'offers') {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'offer') {

                        $arr = [];
                        $arr['id'] = $xml->getAttribute('id');

                        while ($xml->read() && $xml->name != 'offer'):

                            if ($xml->nodeType == \XMLReader::ELEMENT):

                                $name = strtolower($xml->name);
                                $xml->read();

                                $arr[$name] = $xml->value;
                            endif;
                        endwhile;
                        
                        if(!is_null($filter)):
                            if($filter($arr)):
                                yield $arr;
                            endif;
                        else:
                            yield $arr;
                        endif;
                        //yield $arr;

                    }
                }
            }
        }

    }

    public function open($filename)
    {

        $this->filename = $filename;
        $this->xml = new \XMLReader();
        return $this->xml->open($filename);
    }

    public function countOffers(\Closure $filter)
    {
        return 0;
    }
    
    /**
     * Rewinds cursor to the first element
     * 
     * @return boolean
     */
    private function moveToStart()
    {
        $this->xml->close();
        return $this->xml->open($this->filename);
    }
}