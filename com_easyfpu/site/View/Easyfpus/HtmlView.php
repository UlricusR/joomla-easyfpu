<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Site\View\Easyfpus;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;

/**
 * Easyfpus View
 * 
 * @since 0.0.1
 */
class HtmlView extends BaseHtmlView {
    /**
     * Display the Easyfpu view
     * 
     * @param string $tpl The name of the template file to parse; automatically searches through the template paths.
     * 
     * @return void
     */
    function display($tpl = null) {
        // First check if user is logged in
        $user = Factory::getUser();
        
        if ($user->guest) {
            Factory::getApplication()->enqueueMessage(Text::_('COM_EASYFPU_NOTICE_LOGIN'), 'notice');
        } else {
            // Get data from the model
            $this->items            = $this->get('Items');
            $this->pagination       = $this->get('Pagination');
            $this->state			= $this->get('State');
            $this->filterForm    	= $this->get('FilterForm');
            $this->activeFilters 	= $this->get('ActiveFilters');
            $this->validationScript = $this->get('ValidationScript');
            $this->submitButtonScript = $this->get('SubmitButtonScript');
            
            // What Access Permissions does this user have? What can (s)he do?
            $this->canDo = ContentHelper::getActions('com_easyfpu');
            
            // Check for errors
            if (count($errors = $this->get('Errors'))) {
                throw new GenericDataException(implode("\n", $errors), 500);
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
        $document->setTitle(Text::_('COM_EASYFPU_SITE'));
        $document->addStyleSheet(Uri::root() . 'components/com_easyfpu/css/easyfpu.css');
        $document->addScript(Uri::root() . $this->validationScript);
        $document->addScript(Uri::root() . $this->submitButtonScript);
        Text::script('COM_EASYFPU_EASYFPU_ERROR_UNACCEPTABLE');
    }
}