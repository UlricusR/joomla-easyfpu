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
<form action="index.php?option=com_easyfpu&view=newmeal" class="form-validate" method="post" id="adminForm" name="adminForm">

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
			<th width="60%">
				<?php echo JText::_('COM_EASYFPU_EASYFPUS_NAME'); ?>
			</th>
			<th width="38%">
				<?php echo JText::_('COM_EASYFPU_AMOUNT'); ?>
			</th>
			<th width="2%">
				<?php echo JText::_('COM_EASYFPU_ID'); ?>
			</th>
		</tr>
		</thead>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
				    $rowid = $this->pagination->getRowOffset($i);
				?>
					<tr>
						<td>
							<?php echo $row->name; ?>
						</td>
						<td>
							<input name="amount<?php echo $rowid; ?>" list="typicalvalues<?php echo $rowid; ?>">
							<datalist id="typicalvalues<?php echo $rowid; ?>">
            			    	<?php if ($row->amount_small > 0) { ?>
            			    		<option value="<?php echo $row->amount_small; ?>"><?php echo (isset($row->comment_small) && $row->comment_small <> '') ? $row->comment_small : \JText::_('COM_EASYFPU_COMMENT_SMALL_DEFAULT'); ?></option>
            			    	<?php } ?>
            			    	<?php if ($row->amount_medium > 0) { ?>
            			    		<option value="<?php echo $row->amount_medium; ?>"><?php echo (isset($row->comment_medium) && $row->comment_medium <> '') ? $row->comment_medium : \JText::_('COM_EASYFPU_COMMENT_MEDIUM_DEFAULT'); ?></option>
            			    	<?php } ?>
            			    	<?php if ($row->amount_large > 0) { ?>
            			    		<option value="<?php echo $row->amount_large; ?>"><?php echo (isset($row->comment_large) && $row->comment_large <> '') ? $row->comment_large : \JText::_('COM_EASYFPU_COMMENT_LARGE_DEFAULT'); ?></option>
            			    	<?php } ?>
							</datalist>
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
