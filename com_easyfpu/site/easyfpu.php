<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth, Inc. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Factory;

// Get an instance of the controller prefixed by EasyFPU
$controller = JControllerLegacy::getInstance('EasyFPU');

// Perform the requested task; if no task is set, the default task 'display' will be assumed.
// When display is used, the 'view' variable will decide what will be displayed.
$input = Factory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();