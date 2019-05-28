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
 * EasyFPUs View
 * 
 * @since 0.0.1
 */
class EasyFPUViewEasyFPUs extends JViewLegacy {
    /**
     * Display the EasyFPU view
     * 
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * 
     * @return void
     */
    function display($tpl = null) {
        // Get application
        $app = Factory::getApplication();
        $context = "easyfpu.list.site.easyfpu";
        
        // Get data from the model
        $this->items            = $this->get('Items');
        $this->pagination       = $this->get('Pagination');
        //$this->state			= $this->get('State');
        //$this->filterForm    	= $this->get('FilterForm');
        //$this->activeFilters 	= $this->get('ActiveFilters');
        
        // What Access Permissions does this user have? What can (s)he do?
        //$this->canDo = JHelperContent::getActions('com_easyfpu');
        
        // Check for errors
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors), 500);
        }
        
        // Set the submenu
        //EasyFPUHelper::addSubmenu('easyfpus');
        
        // Set the toolbar and number of found items
        //$this->addToolBar();
        
        // Display the template
        parent::display($tpl);
        
        // Set the document
        //$this->setDocument();
    }
    
    /**
     * Add the page title and toolbar
     * 
     * @return void
     * 
     * @since 0.0.8
     */
    protected function addToolBar() {
        $title = JText::_('COM_EASYFPU_MANAGER_EASYFPUS');
        
        if ($this->pagination->total)
        {
            $title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
        }
        
        JToolbarHelper::title($title);
        
        if ($this->canDo->get('core.create')) {
            JToolbarHelper::addNew('easyfpu.add', 'JTOOLBAR_NEW');
        }
        
        if ($this->canDo->get('core.edit')) {
            JToolbarHelper::editList('easyfpu.edit', 'JTOOLBAR_EDIT');
        }
        
        if ($this->canDo->get('core.delete')) {
            JToolbarHelper::deleteList('', 'easyfpus.delete', 'JTOOLBAR_DELETE');
        }
        
        if ($this->canDo->get('core.admin')) {
            JToolBarHelper::divider();
            JToolbarHelper::preferences('com_easyfpu');
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
        $document->setTitle(JText::_('COM_EASYFPU_ADMINISTRATION'));
    }
}