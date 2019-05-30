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
        // Initialize variables
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);
        
        // Make sure the user is logged in in your view.html.php!
        $user = Factory::getUser();

        // Create the base select statement.
        $query->select('*')
            ->from($db->quoteName('#__easyfpu'))
            ->where('created_by = ' . $user->id);
        
        return $query;
    }
}