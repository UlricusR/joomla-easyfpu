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
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

include_once 'AbsorptionScheme.php';
include_once 'AbsorptionBlock.php';
include_once 'FoodItem.php';
include_once 'Meal.php';

/**
 * CalcMeal Model
 *
 * @since  0.0.1
 */
class CalcmealModel extends BaseDatabaseModel
{
    private $foodItems = null;
    private $meal = null;
    private $absorptionScheme = null;
    
    /**
     * Constructor
     * 
     * @param array $config
     */
    public function __construct($config = array()) {
        parent::__construct($config);
        
        // Load absorption scheme
        $path = JPATH_BASE . '/components/com_easyfpu/models/absorptionscheme_default.json';
        $json = file_get_contents($path);
        $absorptionScheme = json_decode($json);
        $absorptionBlocks = array();
        foreach ($absorptionScheme as $absorptionBlock) {
            $maxFPU = intval($absorptionBlock->max_fpu);
            $absorptionTime = intval($absorptionBlock->absorption_time);
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
                $id = intval($result->id);
                $name = $result->name;
                $caloriesPer100g = doubleval($result->calories);
                $carbsPer100g = doubleval($result->carbs);
                $amount = intval($amounts[$id]);
                $foodItem = new FoodItem($id, $amount, $name, $caloriesPer100g, $carbsPer100g);
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
            $this->meal = new Meal(Text::_('COM_EASYFPU_MEAL'), $this->getFoodItems());
            return $this->meal;
        }
    }
    
    public function getAbsorptionScheme() {
        return $this->absorptionScheme;
    }
}