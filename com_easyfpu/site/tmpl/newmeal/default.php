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
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

$ids = array();

HTMLHelper::_('behavior.formvalidator');
?>
<form action="<?php Route::_('index.php?option=com_easyfpu&view=newmeal'); ?>" method="post" id="adminForm" name="adminForm">
	<!-- The introduction -->
	<div class="hint">
		<p><?php echo Text::_('COM_EASYFPU_NEWMEAL_USERHELP'); ?></p>
	</div>
	
	<!-- The toolbar -->
	<div class="btn-toolbar">
		<div class="btn-group">
			<button type="button" class="btn btn-success" onclick="Joomla.submitbutton('calcmeal.calcmeal')">
				<span class="icon-rightarrow"></span><?php echo Text::_('COM_EASYFPU_NEWMEAL') ?>
			</button>
		</div>
	</div>

	<!-- The food list -->
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="60%">
				<?php echo Text::_('COM_EASYFPU_EASYFPUS_NAME'); ?>
			</th>
			<th width="38%">
				<?php echo Text::_('COM_EASYFPU_AMOUNT'); ?>&nbsp;/&nbsp;<?php echo Text::_('COM_EASYFPU_UNIT_GRAMS'); ?>
			</th>
			<th width="2%">
				<?php echo Text::_('COM_EASYFPU_ID'); ?>
			</th>
		</tr>
		</thead>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) : ?>
					<tr>
						<td>
							<?php echo $row->name; ?>
						</td>
						<td>
							<input name="amount<?php echo $row->id; ?>" list="typicalvalues<?php echo $row->id; ?>">
							<datalist id="typicalvalues<?php echo $row->id; ?>">
            			    	<?php if ($row->amount_small > 0) { ?>
            			    		<option value="<?php echo $row->amount_small; ?>"><?php echo (isset($row->comment_small) && $row->comment_small <> '') ? $row->comment_small : Text::_('COM_EASYFPU_COMMENT_SMALL_DEFAULT'); ?></option>
            			    	<?php } ?>
            			    	<?php if ($row->amount_medium > 0) { ?>
            			    		<option value="<?php echo $row->amount_medium; ?>"><?php echo (isset($row->comment_medium) && $row->comment_medium <> '') ? $row->comment_medium : Text::_('COM_EASYFPU_COMMENT_MEDIUM_DEFAULT'); ?></option>
            			    	<?php } ?>
            			    	<?php if ($row->amount_large > 0) { ?>
            			    		<option value="<?php echo $row->amount_large; ?>"><?php echo (isset($row->comment_large) && $row->comment_large <> '') ? $row->comment_large : Text::_('COM_EASYFPU_COMMENT_LARGE_DEFAULT'); ?></option>
            			    	<?php } ?>
							</datalist>
						</td>
						<td align="center">
							<?php 
							    echo $row->id;
							    
							    // Push to ids array
							    array_push($ids, $row->id);
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="ids" value="<?php echo implode(',', $ids); ?>">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
