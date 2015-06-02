<?php

/**
 * @author Serkin Alexander <serkin.alexander@gmail.com>
 * @license https://github.com/serkin/ymlparser/LICENSE MIT
 */

namespace YMLParser\Driver;

class XMLReader implements DriverInterface
{
    /**
     * @var \XMLReader
     */
    private $xml;

    /**
     * Link to stored xml file.
     *
     * @var string
     */
    private $filename;

    /**
     * Gets categories.
     *
     * @return arry Array of \YMLParser\Node\Category instances or empty array
     */
    public function getCategories()
    {
        $returnArr = [];
        $this->moveToStart();
        $xml = $this->xml;

        while ($xml->read()) {
            if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'categories') {
                while ($xml->read() && $xml->name != 'categories') {
                    if ($xml->nodeType == \XMLReader::ELEMENT) {
                        $arr = [];

                        if ($xml->hasAttributes) {

                            while ($xml->moveToNextAttribute()) {
                                $arr[strtolower($xml->name)] = $xml->value;
                            }
                        }

                        $xml->read();
                        $arr['value'] = $xml->value;
                        $returnArr[] = new \YMLParser\Node\Category($arr);

                        unset($arr);
                    }
                }
            }
        }

        return $returnArr;
    }

    /**
     * Gets currencies.
     *
     * @return array
     */
    public function getCurrencies()
    {

        $returnArr = [];
        $this->moveToStart();
        $xml = $this->xml;

        while ($xml->read()) {
            if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'currencies') {
                while ($xml->read() && $xml->name != 'currencies') {
                    if ($xml->nodeType == \XMLReader::ELEMENT) {
                        $arr = [];

                        if ($xml->hasAttributes) {

                            while ($xml->moveToNextAttribute()) {
                                $arr[strtolower($xml->name)] = $xml->value;
                            }
                        }

                        $xml->read();
                        $arr['value'] = $xml->value;
                        $returnArr[] = new \YMLParser\Node\Currency($arr);

                        unset($arr);
                    }
                }
            }
        }

        return $returnArr;
    }

    /**
     * Gets offers.
     *
     * @param \Closure $filter
     *
     * @return array Array of \YMLParser\Node\Offer instances or empty array
     */
    public function getOffers(\Closure $filter = null)
    {
        $this->moveToStart();
        $xml = $this->xml;

        while ($xml->read()) {
            if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'offers') {
                while ($xml->read() && $xml->name != 'offers') {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'offer') {
                        $arr = $this->getElementAttributes($xml);

                        while ($xml->read() && $xml->name != 'offer') {

                            if ($xml->nodeType == \XMLReader::ELEMENT) {

                                $name = mb_strtolower($xml->name);

                                if ($name == 'param') {
                                    $tmpArr = ['name' => $xml->getAttribute('name')];
                                }

                                $xml->read();

                                if ($name == 'param') {
                                    $arr['params'][] = array_merge(['value' => $xml->value], $tmpArr);
                                } else {
                                    $arr[$name] = $xml->value;
                                }
                            }
                        }

                        $returnValue = new \YMLParser\Node\Offer($arr);

                        if (!is_null($filter)) {
                            if ($filter($returnValue)) {
                                yield $returnValue;
                            }
                        } else {
                            yield $returnValue;
                        }
                    }
                }
            }
        }
    }

    /**
     * Gets attributes from element.
     *
     * @param \XMLReader $element
     *
     * @return array
     */
    private function getElementAttributes(\XMLReader $element)
    {
        $returnArr = [];

        if ($element->hasAttributes) {
            while ($element->moveToNextAttribute()) {
                $returnArr[mb_strtolower($element->name)] = $element->value;
            }
        }

        return $returnArr;
    }

    /**
     * Opens file.
     *
     * @param type $filename
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function open($filename)
    {
        $this->filename = $filename;
        $this->xml = new \XMLReader();

        return $this->xml->open($filename);
    }

    /**
     * Gets amount of offers.
     *
     * @param \Closure $filter
     *
     * @return int
     */
    public function countOffers(\Closure $filter = null)
    {
        $returnValue = 0;

        foreach ($this->getOffers($filter) as $el):
            $returnValue++;
        endforeach;

        return $returnValue;
    }

    /**
     * Rewinds cursor to the first element.
     *
     * @return bool
     */
    private function moveToStart()
    {
        $this->xml->close();

        return $this->xml->open($this->filename);
    }
}
