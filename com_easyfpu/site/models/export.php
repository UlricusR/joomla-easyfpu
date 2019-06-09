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
use Joomla\CMS\Log\Log;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Application\WebApplication;
use Joomla\CMS\Router\Route;

/**
 * Export Model
 *
 * @since  0.0.1
 */
class EasyFPUModelCalcMeal extends BaseDatabaseModel
{
    public function getJsonFile()
    {
        // Get the ids
        $ids = $this->getState('ids');
        
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
        
        // Create the json object
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
            
        // Output the JSON data.
        echo json_encode($json_array);
    }
    
    private function generateJson($ids) {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select();
    }
    
}