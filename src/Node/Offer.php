<?php

namespace YMLParser\Node;

class Offer extends \ArrayObject
{
    /**
     * Ges price.
     *
     * @param string $currency
     *
     * @return float
     */
    public function getPrice($currency = 'RUR')
    {
        return 0;
    }
}
