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
 *
 * @since  0.0.1
 */
class EasyFPUViewEasyFPU extends JViewLegacy
{
    /**
     * View form
     *
     * @var form
     */
    protected $form = null;
    
    /**
     * Display the EasyFPU view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        // Get the Data
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->script = $this->get('Script');
        
        // Check for errors
        if (count($errors = $this->get('Errors'))) {
            throw new ErrorException(implode('<br/>', $errors), 500);
            return false;
        }
        
        // Set the toolbar
        $this->addToolBar();
        
        // Display the template
        parent::display($tpl);
        
        // Set the document
        $this->setDocument();
    }
    
    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function addToolBar()
    {
        $input = Factory::getApplication()->input;
        
        // Hide Joomla Administrator Main menu
        $input->set('hidemainmenu', true);
        
        $isNew = ($this->item->id == 0);
        
        if ($isNew) {
            $title = JText::_('COM_EASYFPU_MANAGER_EASYFPU_NEW');
        }
        else {
            $title = JText::_('COM_EASYFPU_MANAGER_EASYFPU_EDIT');
        }
        
        JToolbarHelper::title($title, 'easyfpu');
        JToolbarHelper::save('easyfpu.save');
        JToolbarHelper::cancel(
            'easyfpu.cancel',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );
    }
    
    /**
     * Method to set up the document properties
     *
     * @return void
     */
    protected function setDocument()
    {
        $isNew = ($this->item->id < 1);
        $document = Factory::getDocument();
        $document->setTitle($isNew ? JText::_('COM_EASYFPU_EASYFPU_CREATING') :
            JText::_('COM_EASYFPU_EASYFPU_EDITING'));
        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "/administrator/components/com_easyfpu"
            . "/views/easyfpu/submitbutton.js");
        JText::script('COM_EASYFPU_EASYFPU_ERROR_UNACCEPTABLE');
    }
}