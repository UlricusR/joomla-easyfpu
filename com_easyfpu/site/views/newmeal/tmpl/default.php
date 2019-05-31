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

\JHtml::_('behavior.formvalidator');
?>
<form action="index.php?option=com_easyfpu&view=newmeal" method="post" id="adminForm" name="adminForm">

	<!-- The toolbar -->
	<div class="btn-toolbar">
		<div class="btn-group">
			<button type="button" class="btn btn-success" onclick="Joomla.submitbutton('newmeal.calcmeal')">
				<span class="icon-rightarrow"></span><?php echo JText::_('COM_EASYFPU_NEWMEAL') ?>
			</button>
		</div>
	</div>
	
	<!-- The food list -->
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%">
				<?php echo JText::_('COM_EASYFPU_NUM'); ?>
			</th>
			<th width="98%">
				<?php echo JText::_('COM_EASYFPU_EASYFPUS_NAME'); ?>
			</th>
			<th width="2%">
				<?php echo JText::_('COM_EASYFPU_ID'); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
				    $link = JRoute::_('index.php?option=com_easyfpu&task=easyfpu.edit&id=' . $row->id);
				?>
					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo $row->name; ?>
 						</td>
						<td align="center">
							<?php echo $row->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
    <?php echo JHtml::_('form.token'); ?>
</form>
