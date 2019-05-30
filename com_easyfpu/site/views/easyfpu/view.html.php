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
 * EasyFPU View
 * This is the site view presenting the user with the ability to add a new EasyFPU record
 *
 */
class EasyFPUViewEasyFPU extends JViewLegacy
{
    
    protected $form = null;
    protected $canDo;
    
    /**
     * Display the EasyFPU view
     *
     * @param   string  $tpl  The name of the layout file to parse.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        // Get the form to display
        $this->form = $this->get('Form');
        // Get the javascript script file for client-side validation
        $this->script = $this->get('Script');
        
        // Check that the user has permissions to create a new easyfpu record
        $this->canDo = JHelperContent::getActions('com_easyfpu');
        if (!($this->canDo->get('core.create')))
        {
            $app = Factory::getApplication();
            $app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
            $app->setHeader('status', 403, true);
            return;
        }
        
        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new Exception(implode("\n", $errors), 500);
        }
        
        // Call the parent display to display the layout file
        parent::display($tpl);
        
        // Set properties of the html document
        $this->setDocument();
    }
    
    /**
     * Method to set up the html document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $document = Factory::getDocument();
        $document->setTitle(JText::_('COM_EASYFPU_EASYFPU_CREATING'));
        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "/components/com_easyfpu"
            . "/views/easyfpu/submitbutton.js");
        JText::script('COM_EASYFPU_EASYFPU_ERROR_UNACCEPTABLE');
    }
}