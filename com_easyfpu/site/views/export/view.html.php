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
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Application\WebApplication;

/**
 * Export View
 * This is the site view allowing the user to export food items as json file
 *
 */
class EasyFPUViewCalcMeal extends HtmlView
{
    
    protected $foodItems = null;
    
    /**
     * Display the CalcMeal view
     *
     * @param   string  $tpl  The name of the layout file to parse.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        // TODO Implement
        
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
        $document->setTitle(Text::_('COM_EASYFPU_YOURMEAL'));
        $document->addScript(Uri::root() . $this->script);
        $document->addScript(Uri::root() . "/components/com_easyfpu"
            . "/views/easyfpu/submitbutton.js");
        JText::script('COM_EASYFPU_EASYFPU_ERROR_UNACCEPTABLE');
        
        // Set the MIME type for JSON output.
        $document->setMimeEncoding('application/json');
        
        // Change the suggested filename.
        WebApplication::getInstance()->setHeader('Content-Disposition','attachment;filename="'.$this->getName().'.json"');
    }
}