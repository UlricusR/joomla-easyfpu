<?php
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list');

/**
 * EasyFPU Form Field class for the EasyFPU component
 *
 * @since  0.0.1
 */
class JFormFieldEasyFPU extends JFormFieldList {
    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'EasyFPU';
    
    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select('#__easyfpu.id as id,greeting,#__categories.title as category,catid');
        $query->from('#__easyfpu');
        $query->leftJoin('#__categories on catid=#__categories.id');
        // Retrieve only published items
        $query->where('#__easyfpu.published = 1');
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        $options = array();
        
        if ($messages) {
            foreach ($messages as $message) {
                $options[] = JHtml::_('select.option', $message->id, $message->greeting .
                    ($message->catid ? ' (' . $message->category . ')' : ''));
            }
        }
        
        $options = array_merge(parent::getOptions(), $options);
        
        return $options;
    }
}