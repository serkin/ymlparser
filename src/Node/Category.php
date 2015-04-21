<?php

/**
 * @author Serkin Alexander <serkin.alexander@gmail.com>
 * @license https://github.com/serkin/ymlparser/LICENSE.md MIT
 */
namespace YMLParser\Node;

class Category extends \ArrayObject
{
    /**
     * Gets all category's children categories
     * 
     * @return array Array of YMLParser\Node\Category or empty array
     */
    public function getChildren()
    {}
    
    /**
     * Gets category's parent category
     * 
     * @return Category|null
     */
    public function getParentCategory()
    {}
    
    /**
     * Checks wether category has parent category or not
     * 
     * @return boolean
     */
    public function hasParentCategory()
    {}
}