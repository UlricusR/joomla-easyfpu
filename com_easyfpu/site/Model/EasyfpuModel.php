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
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Language\Text;

/**
 * Easyfpu Model
 *
 * @since  0.0.1
 */
class EasyfpuModel extends AdminModel
{
    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $name    The table name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $options Configuration array for model. Optional.
     *
     * @return  Table  A JTable object
     *
     * @since   1.6
     */
    public function getTable($name = '', $prefix = '', $options = array())
    {
        $name = 'Easyfpu';
        $prefix = 'Table';
        
        if ($table = $this->_createTable($name, $prefix, $options)) {
            return $table;
        }
        
        throw new \Exception(Text::sprintf('JLIB_APPLICATION_ERROR_TABLE_NAME_NOT_SUPPORTED', $name), 0);
    }
    
    /**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm(
            'com_easyfpu.easyfpu',
            'easyfpu',
            array(
                'control' => 'jform',
                'load_data' => $loadData
            )
        );
        
        if (empty($form)) {
            return false;
        }
        
        return $form;
    }
    
    /**
     * Method to get the validation script that have to be included on the form
     *
     * @return string	Script files
     */
    public function getValidationScript()
    {
        return 'administrator/components/com_easyfpu/forms/easyfpu.js';
    }
    
    /**
     * Method to get the submit button script that have to be included on the form
     *
     * @return string	Script files
     */
    public function getSubmitButtonScript()
    {
        return 'administrator/components/com_easyfpu/View/Easyfpu/submitbutton.js';
    }
    
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData()
    {
        // Check the session for previously entered form data.
        $data = Factory::getApplication()->getUserState(
            'com_easyfpu.edit.easyfpu.data',
            array()
        );
        
        if (empty($data)) {
            $data = $this->getItem();
        }
        
        return $data;
    }
    
    /**
     * Method to check if it's OK to delete a fooditem. Overrides JModelAdmin::canDelete
     */
    protected function canDelete($record)
    {
        if( !empty( $record->id ) )
        {
            return Factory::getUser()->authorise( "core.delete", "com_easyfpu.easyfpu." . $record->id );
        }
    }
}