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
 * NewMeal View
 * 
 * @since 0.0.1
 */
class EasyFPUViewNewMeal extends JViewLegacy {
    /**
     * Display the EasyFPU view
     * 
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * 
     * @return void
     */
    function display($tpl = null) {
        // First check if user is logged in
        $user = Factory::getUser();
        
        if ($user->guest) {
            Factory::getApplication()->enqueueMessage(JText::_('COM_EASYFPU_NOTICE_LOGIN'), 'notice');
        } else {
            // Get data from the model
            $this->items            = $this->get('Items');
            $this->pagination       = $this->get('Pagination');
            $this->state			= $this->get('State');

            // Get the selected ids and pass it to the model
            //$ids = Factory::getApplication()->input->getString('ids', '');
            //$this->state->set('food.ids', $ids);
            
            // What Access Permissions does this user have? What can (s)he do?
            $this->canDo = JHelperContent::getActions('com_easyfpu');
            
            // Check for errors
            if (count($errors = $this->get('Errors'))) {
                throw new Exception(implode("\n", $errors), 500);
            }
            
            // Display the template
            parent::display($tpl);
            
            // Set the document
            $this->setDocument();
        }
    }
    
    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $document = Factory::getDocument();
        $document->setTitle(JText::_('COM_EASYFPU_SITE'));
    }
}