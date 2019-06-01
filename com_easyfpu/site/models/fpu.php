<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

class FPU {
    private $fpu;
    
    /**
     * Constructor
     * @param double $fpu
     */
    public function __construct($fpu) {
        $this->$fpu = $fpu;
    }
    
    /**
     * @return double the FPUs
     */
    public function getFpu()
    {
        return $this->fpu;
    }
    
    /**
     * @return double the extended carbs in grams
     */
    public function getExtendedCarbs() {
        return $this->fpu * 10;
    }
}