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

// Set some global property
$document = Factory::getDocument();
$document->addStyleDeclaration('.icon-easyfpu {background-image: url(../media/com_easyfpu/images/easyfpu-16x16.png);}');

// Require helper file
JLoader::register('EasyFPUHelper', JPATH_COMPONENT . '/helpers/easyfpu.php');

// Get an instance of the controller prefixed by EasyFPU
$controller = JControllerLegacy::getInstance('EasyFPU');

// Perform the Request Task
$controller->execute(Factory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();