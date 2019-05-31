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

// TODO Adapt!

// Imports
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\FormModel;

/**
 * EasyFPU Model
 *
 * @since  0.0.1
 */
class EasyFPUModelCalcMeal extends FormModel
{
    /**
     * Stores amounts
     * @var amounts The amounts as id->amount array
     */
    public $amounts;
    
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
    
    public function getAmounts()
    {
        return $this->amounts;
    }
    
    /**
     * Method to get the script that have to be included on the form
     *
     * @return string	Script files
     */
    public function getScript()
    {
        return 'components/com_easyfpu/models/forms/easyfpu.js';
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
}