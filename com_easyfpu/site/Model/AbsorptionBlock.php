<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Site\Model;

// No direct access
defined('_JEXEC') or die;

class AbsorptionBlock {
    private $maxFPU;
    private $absorptionTime;
    
    /**
     * Constructs a new AbsorptionBlock.
     *
     * @param maxFPU         The maximum amount of FPU.
     * @param absorptionTime The absorption time for the maximum amount of FPU in hours.
     */
    public function __construct($maxFPU, $absorptionTime) {
        $this->maxFPU = $maxFPU;
        $this->absorptionTime = $absorptionTime;
    }
    
    /**
     * @return int
     */
    public function getMaxFPU()
    {
        return $this->maxFPU;
    }
    
    /**
     * @return int
     */
    public function getAbsorptionTime()
    {
        return $this->absorptionTime;
    }
}