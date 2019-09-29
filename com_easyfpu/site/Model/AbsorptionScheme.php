<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\EasyFPU\Site\Model;

// No direct access
defined('_JEXEC') or die;

class AbsorptionScheme {
    private $absorptionBlocks;
    
    public function __construct($absorptionBlocks) {
        $this->absorptionBlocks = $absorptionBlocks;
    }
    
    /**
     * @return array The absorption blocks
     */
    public function getAbsorptionBlocks() {
        return $this->absorptionBlocks;
    }
    
    public function setAbsorptionBlocks($absorptionBlocks) {
        $this->absorptionBlocks = $absorptionBlocks;
    }
    
    /**
     * Picks the absorption time associated to the number of FPUs, e.g.:
     * <p>absorptionScheme: 0-1 FPU - 3 hours; 1-2 FPU - 4 hours; 2-3 FPUs - 5 hours; 3-4 FPUs - 6 hours; >4 FPUs - 8 hours</p>
     * <p>The fpu value is commercially rounded to 0 digits, i.e. 2.49 will be rounded to 2, 2.50 will be rounded to 3.</p>
     * <p>If the fpu value is beyond the last scheme block, the time of the last scheme block in the array is returned.</p>
     *
     * @param fpus The calculated FPUs.
     * @return int associated absorption time.
     */
    public function getAbsorptionTime($fpus) {
        // Round the fpus
        $roundedFPUs = round($fpus);
        
        // Find associated absorption time
        foreach ($this->absorptionBlocks as $absorptionBlock) {
            if ($roundedFPUs <= $absorptionBlock->getMaxFPU()) {
                return $absorptionBlock->getAbsorptionTime();
            }
        }
        
        // Seems to be beyond the last block, so return time of the last block
        return $this->getMaximumAbsorptionTime();
    }
    
    public function getMaximumAbsorptionTime() {
        return $this->absorptionBlocks[count($this->absorptionBlocks) - 1]->getAbsorptionTime();
    }
    
    public function getMaximumFPUs() {
        return $this->absorptionBlocks[count($this->absorptionBlocks) - 1]->getMaxFPU();
    }
    
    public function toString() {
        $returnString = "Absorption Scheme:";
        foreach ($this->absorptionBlocks as $absorptionBlock) {
            $returnString += " (" . $absorptionBlock->getMaxFPU() . "FPU -> " . $absorptionBlock->getAbsorptionTime() . "h)";
        }
        return $returnString;
    }
    
    public function equals($absorptionScheme) {
        if ($this == absorptionScheme) return true;
        if (!($absorptionScheme != null && get_class($this) == get_class($absorptionScheme))) {
            return false;
        }
        return $this->toString() == $absorptionScheme->toString();
    }
}