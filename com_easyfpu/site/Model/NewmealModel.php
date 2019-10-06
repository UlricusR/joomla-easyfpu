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
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Language\Text;

/**
 * EasyfpuList Model
 *
 * @since  0.0.1
 */
class NewmealModel extends ListModel
{
    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {
        // Get the selected IDs
        $ids = $this->getState('ids');
        if (isset($ids)) {
            // Initialize variables
            $db    = Factory::getDbo();
            $query = $db->getQuery(true);
            
            // Make sure the user is logged in in your view.html.php!
            $user = Factory::getUser();
    
            // Create the base select statement; we add the user as criterium for security reasons
            $query->select('*')
                ->from($db->quoteName('#__easyfpu'))
                ->where('created_by = ' . $user->id)
                ->andWhere('id IN (' . implode(',', $ids) .')');
            
            return $query;
        } else {
            Log::add(Text::_('COM_EASYFPU_ERRMSG_DATALOADING'), Log::ERROR, 'jerror');
        }
    }
}