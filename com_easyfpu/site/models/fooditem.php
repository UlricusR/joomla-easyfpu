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

class FoodItem {
    private $id;
    private $amount;
    private $name;
    private $caloriesPer100g;
    private $carbsPer100g;
    
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
     * Calculates the Fat Protein Units of the food.
     *
     * @return FPU the FPUs associated with that food
     */
    public function getFPU() {
        // 1g carbs has ~4 kcal, so calculate carb portion of calories
        $carbsCal = $this->amount / 100 * $this->carbsPer100g * 4;
        
        // The carbs from fat and protein is the remainder
        $calFromFP = $this->getCalories() - $carbsCal;
        
        // 100kcal makes 1 FPU
        $fpus = $calFromFP / 100;
        
        // Create and return the FPU object
        return new FPU($fpus);
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

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param double $caloriesPer100g
     */
    public function setCaloriesPer100g($caloriesPer100g)
    {
        $this->caloriesPer100g = $caloriesPer100g;
    }

    /**
     * @param double $carbsPer100g
     */
    public function setCarbsPer100g($carbsPer100g)
    {
        $this->carbsPer100g = $carbsPer100g;
    }
}