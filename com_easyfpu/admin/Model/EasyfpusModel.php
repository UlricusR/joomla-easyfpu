<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Administrator\Model;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Easyfpu List Model
 * 
 * @since 0.0.1
 */
class EasyfpusModel extends ListModel {
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @since   1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id',
                'name',
                'favorite',
                'calories',
                'carbs',
                'amount_small',
                'amount_medium',
                'amount_large',
                'comment_small',
                'comment_medium',
                'comment_large',
                'author',
                'created',
                'published'
            );
        }
        
        parent::__construct($config);
    }
    
    /**
     * Method to build an SQL query to load the list data
     * 
     * @return string An SQL query
     */
    protected function getListQuery() {
        // Initialize variables
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        
        // Create the base select statement
        $query->select('a.id as id, a.name as name, a.favorite as favorite, a.calories as calories, a.carbs as carbs,
                        a.amount_small as amount_small, a.amount_medium as amount_medium, a.amount_large as amount_large,
                        a.comment_small as comment_small, a.comment_medium as comment_medium, a.comment_large as comment_large,
                        a.published as published, a.created as created')
            ->from($db->quoteName('#__easyfpu', 'a'));
        
        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
              ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = a.created_by');
        
        // Filter: like / search
        $search = $this->getState('filter.search');
        
        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%');
            $query->where('name LIKE ' . $like);
        }
        
        // Filter by published state
        $published = $this->getState('filter.published');
        
        if (is_numeric($published))
        {
            $query->where('a.published = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(a.published IN (0, 1))');
        }
        
        // Add the list ordering clause.
        $orderCol	= $this->state->get('list.ordering', 'name');
        $orderDirn 	= $this->state->get('list.direction', 'asc');
        
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
    
        return $query;
    }
}