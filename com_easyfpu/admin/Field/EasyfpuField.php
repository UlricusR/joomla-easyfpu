<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Administrator\Field;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\HTML\HTMLHelper;

FormHelper::loadFieldClass('list');

/**
 * Easyfpu Form Field class for the Easyfpu component
 *
 * @since  0.0.1
 */
class EasyfpuField extends JFormFieldList {
    /**
     * The field type.
     *
     * @var         string
     */
    protected $type = 'Easyfpu';
    
    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
    protected function getOptions() {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select('#__easyfpu.id as id,name');
        $query->from('#__easyfpu');
        // Retrieve only published items
        $query->where('#__easyfpu.published = 1');
        $db->setQuery((string) $query);
        $fooditems = $db->loadObjectList();
        $options = array();
        
        if ($fooditems) {
            foreach ($fooditems as $fooditem) {
                $options[] = HTMLHelper::_('select.option', $fooditem->id, $fooditem->name);
            }
        }
        
        $options = array_merge(parent::getOptions(), $options);
        
        return $options;
    }
}