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

JHtml::_('formbehavior.chosen', 'select');

//$listOrder     = $this->escape($this->state->get('list.ordering'));
//$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<form action="index.php?option=com_easyfpu&view=easyfpus" method="post" id="adminForm" name="adminForm">
    	<table class="table table-striped table-hover">
    		<thead>
    		<tr>
    			<th width="1%">
    				<?php echo JText::_('COM_EASYFPU_NUM'); ?>
    			</th>
    			<th width="2%">
    				<?php echo JHtml::_('grid.checkall'); ?>
    			</th>
    			<th width="95%">
    				<?php echo JText::_('COM_EASYFPU_EASYFPUS_NAME'); ?>
    			</th>
    			<th width="2%">
    				<?php echo JText::_('COM_EASYFPU_ID'); ?>
    			</th>
    		</tr>
    		</thead>
    		<tfoot>
    			<tr>
    				<td colspan="4">
    					<?php echo $this->pagination->getListFooter(); ?>
    				</td>
    			</tr>
    		</tfoot>
    		<tbody>
    			<?php if (!empty($this->items)) : ?>
    				<?php foreach ($this->items as $i => $row) : ?>
    					<tr>
    						<td>
    							<?php echo $this->pagination->getRowOffset($i); ?>
    						</td>
    						<td>
    							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
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
</form>