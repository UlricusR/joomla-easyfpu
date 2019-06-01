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

class Meal {
    // Meal name
    private $name;
    private $calories = 0.0;
    private $carbs = 0.0;
    private $amount = 0;
    private $fpus = null;
    
    /**
     * Constructs a new meal.
     *
     * @param name The name of the meal
     * @param food A list of all food of the meal
     */
    public function __construct($name, $foodList) {
        $this->name = $name;
        
        $tempFPUs = 0;
        
        // Calculate calories, carbs and FPUs
        for ($i = 0; i <  count($foodList); $i++) {
            $this->calories += $foodList[$i]->getCalories();
            $this->carbs += $foodList[$i]->getCarbs();
            $this->amount += $foodList[$i]->getAmount();
            $tempFPUs += $foodList[$i]->getFPU()->getFPU();
        }
        
        $this->fpus = new FPU($tempFPUs);
    }
    
    /**
     * @return string The name of the meal.
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @return double The calories of the meal in kcal
     */
    public function getCalories() {
        return $this->calories;
    }
    
    /**
     * @return double The carbs of the meal in g
     */
    public function getCarbs() {
        return $this->carbs;
    }
    
    /**
     * @return int The amount of the meal in g
     */
    public function getAmount() {
        return $this->amount;
    }
    
    /**
     * @return FPU The FPUs of the meal
     */
    public function getFPUs() {
        return $this->fpus;
    }
}