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
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * EasyFPUList Model
 *
 * @since  0.0.1
 */
class EasyFPUModelNewMeal extends ListModel
{
    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {
        // Get the selected IDs
        $ids = Factory::getApplication()->input->getString('ids', '');
        
        // Initialize variables
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);
        
        // Make sure the user is logged in in your view.html.php!
        $user = Factory::getUser();

        // Create the base select statement; we add the user as criterium as we pass the IDs via URL,
        // so this makes sure that we cannot retrieve food items not belonging to the user in case
        // of manually manipulated URL parameters
        $query->select('*')
            ->from($db->quoteName('#__easyfpu'))
            ->where('created_by = ' . $user->id)
            ->andWhere('id IN (' . $ids .')');
        
        return $query;
    }
}