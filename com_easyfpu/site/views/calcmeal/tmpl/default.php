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
?>

<table>
	<tr>
		<th><?php echo \JText::_('COM_EASYFPU_EASYFPU_NAME_LABEL'); ?></th>
		<th><?php echo \JText::_('COM_EASYFPU_AMOUNT'); ?></th>
		<th><?php echo \JText::_('COM_EASYFPU_CALORIES'); ?></th>
		<th><?php echo \JText::_('COM_EASYFPU_CARBS'); ?></th>
		<th><?php echo \JText::_('COM_EASYFPU_FPU'); ?></th>
		<th><?php echo \JText::_('COM_EASYFPU_EXTENDED_CARBS'); ?></th>
		<th><?php echo \JText::_('COM_EASYFPU_ABSORPTION_TIME'); ?></th>
	</tr>
    <!--
	<tr>
		<td><?php echo $this->meal->getName(); ?></td>
		<td><?php echo $this->meal->getAmount(); ?></td>
		<td><?php echo $this->meal->getCalories(); ?></td>
		<td><?php echo $this->meal->getCarbs(); ?></td>
		<td><?php echo $this->meal->getFPU()->getFPU(); ?></td>
		<td><?php echo $this->meal->getFPU()->getExtendedCarbs(); ?></td>
		<td><?php echo $this->absorptionScheme->getAbsorptionTime($this->meal->getFPU()->getFPU()); ?></td>
	</tr>
	-->
</table>
