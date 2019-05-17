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

/**
 * HTML View class for the EasyFPU Component
 *
 * @since  0.1.0
 */
class EasyFPUViewEasyFPU extends JViewLegacy {
    /**
     * Display the EasyFPU view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    function display($tpl = null) {
        // Assign data to the view; the get method coverts the get('Msg') call into a getMsg() call on the model,
        // therefore in the model class we need to provide a getMsg() method.
        $this->msg = $this->get('Msg');
        
        // Check for errors
        if (count($errors = $this->get('Errors'))) {
            JLog::add(implode('<br/>', $errors), JLog::WARNING, 'jerror');
            return false;
        }
        
        // Display the view
        parent::display($tpl);
    }
}