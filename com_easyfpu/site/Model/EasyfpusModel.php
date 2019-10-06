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

/**
 * EasyfpuList Model
 *
 * @since  0.0.1
 */
class EasyfpusModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     ListModel
     * @since   1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id',
                'name'
            );
        }
        
        parent::__construct($config);
    }
    
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
        
        // Filter: like / search
        $search = $this->getState('filter.search');
        
        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%');
            $query->where('name LIKE ' . $like);
        }
        
        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering', 'name');
        $orderDirn 	= $this->state->get('list.direction', 'asc');
        
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
        
        return $query;
    }
}