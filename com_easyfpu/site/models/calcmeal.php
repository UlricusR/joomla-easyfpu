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

// Imports
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;

include_once 'absorptionscheme.php';
include_once 'absorptionblock.php';
include_once 'fooditem.php';
include_once 'fpu.php';
include_once 'meal.php';

/**
 * EasyFPU Model
 *
 * @since  0.0.1
 */
class EasyFPUModelCalcMeal extends BaseDatabaseModel
{
    private $foodItems = null;
    private $meal = null;
    private $absorptionScheme = null;
    
    public function __construct($config = array()) {
        parent::__construct($config);
        
        // Load absorption scheme
        $json = file_get_contents(JPATH_BASE . 'components/com_easyfpu/models/absorptionscheme_default.json');
        $absorptionScheme = json_decode($json);
        $absorptionBlocks = array();
        foreach ($absorptionScheme as $absorptionBlock) {
            $maxFPU = intval($absorptionBlock['max_fpu']);
            $absorptionTime = intval($absorptionBlock['absorption_time']);
            array_push($absorptionBlocks, new AbsorptionBlock($maxFPU, $absorptionTime));
        }
        $this->absorptionScheme = new AbsorptionScheme($absorptionBlocks);
    }
    
    /**
     * Returns the individual food items
     * @return array FoodItem an array of food items
     */
    public function getFoodItems() {
        if (isset($this->foodItems)) {
            return $this->foodItems;
        } else {
            // Get the ids
            $amounts = $this->getState('amounts');
            $ids = array_keys($amounts);
            
            // Get the user
            $user = Factory::getUser();
            
            // Load the food item from the database
            $db = Factory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*')
                ->from($db->quoteName('#__easyfpu'))
                ->where('created_by = ' . $user->id)
                ->andWhere('id IN (' . implode(',', $ids) .')');
            $db->setQuery($query);
            $results = $db->loadObjectList();
            
            // Create the food items
            $foodItems = array();
            foreach ($results as $result) {
                $id = intval($result['id']);
                $foodItem = new FoodItem();
                $foodItem->setId($id);
                $foodItem->setName($result['name']);
                $foodItem->setCaloriesPer100g($result['calories']);
                $foodItem->setCarbsPer100g($result['carbs']);
                $foodItem->setAmount(intval($amounts[$id]));
                array_push($foodItems, $foodItem);
            }
            
            // Set the food items
            $this->foodItems = $foodItems;
            return $foodItems;
        }
    }
    
    /**
     * Returns the complete meal
     * @return Meal the FPUs of the complete meal
     */
    public function getMeal() {
        if (isset($this->meal)) {
            return $this->meal;
        } else {
            $this->meal = new Meal(\JText::_('COM_EASYFPU_YOURMEAL'), $this->foodItems);
            return $this->meal;
        }
    }
    
    public function getAbsorptionScheme() {
        return $this->absorptionScheme;
    }
}