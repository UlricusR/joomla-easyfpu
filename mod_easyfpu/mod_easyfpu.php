<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth, Inc. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

// Include the eventlist functions only once
JLoader::register('ModEasyFPUHelper', __DIR__ . '/helper.php');
//include __DIR__ . '/helper.php';

// Get mod_easyfpu parameters
$module = JModuleHelper::getModule('mod_easyfpu');
$params = new JRegistry($module->params);

$eventList = ModEasyFPUHelper::getList($params);
	
require JModuleHelper::getLayoutPath('mod_easyfpu', 'default');
