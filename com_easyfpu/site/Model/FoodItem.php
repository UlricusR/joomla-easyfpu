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

// Imports
use Joomla\CMS\Log\Log;
use Joomla\CMS\Language\Text;

class FoodItem {
    private $id;
    private $amount;
    private $name;
    private $caloriesPer100g;
    private $carbsPer100g;
    private $fpus;
    
    public function __construct($id, $amount, $name, $caloriesPer100g, $carbsPer100g) {
        $this->id = $id;
        $this->amount = $amount;
        $this->name = $name;
        $this->caloriesPer100g = $caloriesPer100g;
        $this->carbsPer100g = $carbsPer100g;
        
        // Calculate FPUs
        
        // 1g carbs has ~4 kcal, so calculate carb portion of calories
        $carbsCal = $this->getCarbs() * 4;
        
        // The carbs from fat and protein is the remainder
        $calFromFP = $this->getCalories() - $carbsCal;
        
        if ($calFromFP < 0) {
            // Covers the case that calories from carbs exceed total calories
            Log::add(Text::_('COM_EASYFPU_EASYFPU_ERRMSG_TOOMUCHCARBS') . ': ' . $name, Log::ERROR, 'jerror');
        }
        
        // 100kcal makes 1 FPU
        $this->fpus = $calFromFP / 100;
    }
    
    /**
     * @return double the actual calories of the food item
     */
    public function getCalories() {
        return $this->amount * $this->caloriesPer100g / 100;
    }
    
    /**
     * @return double the actual carbs of the food item
     */
    public function getCarbs() {
        return $this->amount * $this->carbsPer100g / 100;
    }
    
    /**
     * @return double the FPUs associated with that food
     */
    public function getFPU() {
        return $this->fpus;
    }
    
    /**
     * Calculates the extended carbs (1 FPU = 10g extended carbs)
     *
     * @return double the extended carbs
     */
    public function getExtendedCarbs() {
        return $this->fpus * 10;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return double
     */
    public function getCaloriesPer100g()
    {
        return $this->caloriesPer100g;
    }

    /**
     * @return double
     */
    public function getCarbsPer100g()
    {
        return $this->carbsPer100g;
    }
}