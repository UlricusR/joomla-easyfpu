<?php
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth, Inc. All rights reserved.
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
        $query->select('id,greeting');
        $query->from('#__easyfpu');
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        $options = array();
        
        if ($messages) {
            foreach ($messages as $message) {
                $options[] = JHtml::_('select.option', $message->id, $message->greeting);
            }
        }
        
        $options = array_merge(parent::getOptions(), $options);
        
        return $options;
    }
}