<?php

/**
 * @author Serkin Alexander <serkin.alexander@gmail.com>
 * @license https://github.com/serkin/ymlparser/LICENSE MIT
 */

namespace YMLParser\Node;

class Offer extends \ArrayObject {

    /**
     * Ges price.
     *
     * @param string $currency
     *
     * @return integer
     */
    public function getPrice($currency = 'RUR') {
        return 0;
    }

}
