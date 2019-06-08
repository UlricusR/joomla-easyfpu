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
use Joomla\CMS\MVC\Controller\BaseController;

/**
 * General Controller of EasyFPU component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 * @since       0.0.7
 */
class EasyFPUController extends BaseController
{
    /**
     * The default view for the display method.
     *
     * @var string
     * @since 0.0.7
     */
    protected $default_view = 'easyfpus';
}