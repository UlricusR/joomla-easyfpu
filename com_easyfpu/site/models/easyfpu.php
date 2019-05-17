<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth, Inc. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * EasyFPU model
 * 
 * @since 0.0.1
 */
class EasyFPUModelEasyFPU extends JModelItem {
    /**
     * @var array messages
     */
    protected $messages;
    
    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $type    The table name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   0.0.1
     */
    public function getTable($type = 'EasyFPU', $prefix = 'EasyFPUTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    /**
     * Get the message
     * 
     * @param integer $id Greeting id
     * 
     * @return string The message to be displayed to the user
     */
    public function getMsg($id = 1) {
        if (!is_array($this->messages)) {
            $this->messages = array();
        }
        
        if (!isset($this->messages[$id])) {
            // Request the selected id
            $jinput = Factory::getApplication()->input;
            $id     = $jinput->get('id', 1, 'INT');
            
            // Get a TableEasyFPU instance
            $table = $this->getTable();
            
            // Load the message
            $table->load($id);
            
            // Assign the message
            $this->messages[$id] = $table->greeting;
        }
        
        return $this->messages[$id];
    }
}