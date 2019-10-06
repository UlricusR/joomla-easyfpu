<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Site\Controller;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Display Controller
 *
 * @package     Joomla.Site
 * @subpackage  com_easyfpu
 *
 * Entry point of component
 *
 */
class DisplayController extends BaseController {

	/**
	 * The default view.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $default_view = 'easyfpus';
	
    /**
     * Method to display a view.
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
     *
     * @return  static  This object to support chaining.
     *
     * @since   0.1
     */
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display();
    }
}
