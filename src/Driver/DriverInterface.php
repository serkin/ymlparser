<?php

/**
 * @author Serkin Alexander <serkin.alexander@gmail.com>
 * @license https://github.com/serkin/ymlparser/LICENSE MIT
 */

namespace YMLParser\Driver;

interface DriverInterface
{
    /**
     * Creates XML Parser according with driver.
     *
     * @param string $xml Valid xml string
     */
    public function open($xml);

    /**
     * Gets array of file categories.
     *
     * @return array
     */
    public function getCategories();

    /**
     * Gets offers from file.
     *
     * You can specify filter function which get each element as param and return boolean
     *
     * @param \Closure $filter
     *
     * @return \Generator
     */
    public function getOffers(\Closure $filter = null);

    /**
     * Gets current currencies from file.
     *
     * @return array
     */
    public function getCurrencies();

    /**
     * Count offers in file.
     *
     * You can specify filter function which get each element as param and return boolean
     *
     * @param \Closure $filter
     *
     * @return int
     */
    public function countOffers(\Closure $filter);
}
