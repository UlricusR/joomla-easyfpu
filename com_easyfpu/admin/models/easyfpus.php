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

/**
 * EasyFPU List Model
 * 
 * @since 0.0.1
 */
class EasyFPUModelEasyFPUs extends JModelList {
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     JController
     * @since   1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id',
                'greeting',
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
        $query->select('a.id as id, a.greeting as greeting, a.published as published, a.created as created')
            ->from($db->quoteName('#__easyfpu', 'a'));
        
        // Join over categories
        $query->select($db->quoteName('c.title', 'category_title'))
              ->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = a.catid');
        
        // Join with users table to get the username of the author
        $query->select($db->quoteName('u.username', 'author'))
              ->join('LEFT', $db->quoteName('#__users', 'u') . ' ON u.id = a.created_by');
        
        // Filter: like / search
        $search = $this->getState('filter.search');
        
        if (!empty($search))
        {
            $like = $db->quote('%' . $search . '%');
            $query->where('greeting LIKE ' . $like);
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
        $orderCol	= $this->state->get('list.ordering', 'greeting');
        $orderDirn 	= $this->state->get('list.direction', 'asc');
        
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
    
        return $query;
    }
}