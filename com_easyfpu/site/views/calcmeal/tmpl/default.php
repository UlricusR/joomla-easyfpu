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

<table class="table table-striped table-hover">
	<thead>
    	<tr>
    		<th><?php echo \JText::_('COM_EASYFPU_EASYFPU_NAME_LABEL'); ?></th>
    		<th><?php echo \JText::_('COM_EASYFPU_AMOUNT'); ?></th>
    		<th><?php echo \JText::_('COM_EASYFPU_CALORIES'); ?></th>
    		<th><?php echo \JText::_('COM_EASYFPU_CARBS'); ?></th>
    		<th><?php echo \JText::_('COM_EASYFPU_FPU'); ?></th>
    		<th><?php echo \JText::_('COM_EASYFPU_EXTENDED_CARBS'); ?></th>
    		<th><?php echo \JText::_('COM_EASYFPU_ABSORPTION_TIME'); ?></th>
    	</tr>
    	<tr>
    		<td></td>
    		<td><?php echo \JText::_('COM_EASYFPU_UNIT_GRAMS'); ?></td>
    		<td><?php echo \JText::_('COM_EASYFPU_UNIT_KCAL'); ?></td>
    		<td><?php echo \JText::_('COM_EASYFPU_UNIT_GRAMS'); ?></td>
    		<td></td>
    		<td><?php echo \JText::_('COM_EASYFPU_UNIT_GRAMS'); ?></td>
    		<td><?php echo \JText::_('COM_EASYFPU_UNIT_HOURS'); ?></td>
    	</tr>
	</thead>
	<tbody>
    	<tr>
    		<td><?php echo $this->meal->getName(); ?></td>
    		<td align="right"><?php echo $this->meal->getAmount(); ?></td>
    		<td align="right"><?php echo number_format($this->meal->getCalories(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo number_format($this->meal->getCarbs(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo number_format($this->meal->getFPU(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo number_format($this->meal->getExtendedCarbs(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo $this->absorptionScheme->getAbsorptionTime($this->meal->getFPU()); ?></td>
    	</tr>
    	<?php foreach ($this->foodItems as $fooditem) { ?>
    	<tr>
    		<td><?php echo $fooditem->getName(); ?></td>
    		<td align="right"><?php echo $fooditem->getAmount(); ?></td>
    		<td align="right"><?php echo number_format($fooditem->getCalories(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo number_format($fooditem->getCarbs(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo number_format($fooditem->getFPU(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo number_format($fooditem->getExtendedCarbs(), $this->numberDecimals, $this->decimalSeparator, $this->thousandsDelimiter); ?></td>
    		<td align="right"><?php echo $this->absorptionScheme->getAbsorptionTime($fooditem->getFPU()); ?></td>
    	</tr>
    	<?php } ?>
	</tbody>
</table>
