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
     * @param foodItems A list of all food of the meal
     */
    public function __construct($name, $foodItems) {
        $this->name = $name;
        
        $tempFPUs = 0;
        
        // Calculate calories, carbs and FPUs
        foreach ($foodItems as $foodItem) {
            $this->calories += $foodItem->getCalories();
            $this->carbs += $foodItem->getCarbs();
            $this->amount += $foodItem->getAmount();
            $tempFPUs += $foodItem->getFPU();
        }
        
        $this->fpus = $tempFPUs;
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
     * @return double The FPUs of the meal
     */
    public function getFPU() {
        return $this->fpus;
    }
}