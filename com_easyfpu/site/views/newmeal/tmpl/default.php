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

// Get items to add to meal.
$input = Factory::getApplication()->input;
$ids = $input->get('ids');
var_dump($ids);

\JHtml::_('behavior.formvalidator');

