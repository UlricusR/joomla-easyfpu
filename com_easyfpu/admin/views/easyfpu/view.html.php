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
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Uri\Uri;

/**
 * EasyFPU View
 *
 * @since  0.0.1
 */
class EasyFPUViewEasyFPU extends HtmlView
{
    protected $form;
    protected $item;
    protected $script;
    protected $canDo;
    
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
        
        // What Access Permissions does this user have? What can (s)he do?
        $this->canDo = ContentHelper::getActions('com_easyfpu', 'easyfpu', $this->item->id);
        
        // Check for errors
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors), 500);
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
            // For new records, check the create permission.
            if ($this->canDo->get('core.create'))
            {
                ToolbarHelper::apply('easyfpu.apply', 'JTOOLBAR_APPLY');
                ToolBarHelper::save('easyfpu.save', 'JTOOLBAR_SAVE');
                ToolBarHelper::custom('easyfpu.save2new', 'save-new.png', 'save-new_f2.png',
                    'JTOOLBAR_SAVE_AND_NEW', false);
            }
            ToolBarHelper::cancel('easyfpu.cancel', 'JTOOLBAR_CANCEL');
        }
        else {
            if ($this->canDo->get('core.edit'))
            {
                // We can save the new record
                ToolBarHelper::apply('easyfpu.apply', 'JTOOLBAR_APPLY');
                ToolBarHelper::save('easyfpu.save', 'JTOOLBAR_SAVE');
                
                // We can save this record, but check the create permission to see
                // if we can return to make a new one.
                if ($this->canDo->get('core.create'))
                {
                    ToolBarHelper::custom('easyfpu.save2new', 'save-new.png', 'save-new_f2.png',
                        'JTOOLBAR_SAVE_AND_NEW', false);
                }
            }
            if ($this->canDo->get('core.create'))
            {
                ToolBarHelper::custom('easyfpu.save2copy', 'save-copy.png', 'save-copy_f2.png',
                    'JTOOLBAR_SAVE_AS_COPY', false);
            }
            ToolBarHelper::cancel('easyfpu.cancel', 'JTOOLBAR_CLOSE');
        }
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
        $document->addScript(Uri::root() . $this->script);
        $document->addScript(Uri::root() . "/administrator/components/com_easyfpu"
            . "/views/easyfpu/submitbutton.js");
        JText::script('COM_EASYFPU_EASYFPU_ERROR_UNACCEPTABLE');
    }
}