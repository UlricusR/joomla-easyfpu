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

/**
 * EasyFPU View
 * This is the site view presenting the user with the ability to add a new EasyFPU record
 *
 */
class EasyFPUViewCalcMeal extends HtmlView
{
    
    protected $foodItems = null;
    protected $meal = null;
    protected $absorptionScheme = null;
    protected $decimalSeparator = '.';
    protected $numberDecimals = 1;
    protected $thousandsDelimiter = ',';
    
    /**
     * Display the CalcMeal view
     *
     * @param   string  $tpl  The name of the layout file to parse.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        // Load FPU related data
        $this->foodItems = $this->get('FoodItems');
        $this->meal = $this->get('Meal');
        $this->absorptionScheme = $this->get('AbsorptionScheme');
        
        // Load formatting parameters
        $params = Factory::getApplication()->getParams();
        $this->decimalSeparator = $params->get('format_decimal_separator');
        $this->numberDecimals = intval($params->get('format_number_decimals'));
        $this->thousandsDelimiter = $params->get('format_thousands_delimiter');
        
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
        $document->setTitle(\JText::_('COM_EASYFPU_YOURMEAL'));
        $document->addScript(\JUri::root() . $this->script);
        $document->addScript(\JUri::root() . "/components/com_easyfpu"
            . "/views/easyfpu/submitbutton.js");
        JText::script('COM_EASYFPU_EASYFPU_ERROR_UNACCEPTABLE');
    }
}