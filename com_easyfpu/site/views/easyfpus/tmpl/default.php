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
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Language\Text;

HTMLHelper::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<form action="<?php Route::_('index.php?option=com_easyfpu&view=easyfpus'); ?>" method="post" id="adminForm" name="adminForm">

	<!-- The toolbar -->
	<div class="btn-toolbar">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('easyfpus.new')">
				<span class="icon-new"></span><?php echo JText::_('JNEW') ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn" onclick="Joomla.submitbutton('easyfpus.delete')">
				<span class="icon-trash"></span><?php echo JText::_('JACTION_DELETE') ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn" onclick="Joomla.submitbutton('easyfpus.export')">
				<span class="icon-out"></span><?php echo JText::_('COM_EASYFPU_EXPORT') ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn btn-success" onclick="Joomla.submitbutton('newmeal.newmeal')">
				<span class="icon-rightarrow"></span><?php echo JText::_('COM_EASYFPU_NEWMEAL') ?>
			</button>
		</div>
	</div>
	
	<!-- The search field -->
	<div class="row-fluid">
		<div class="span12">
			<?php echo Text::_('COM_EASYFPU_EASYFPUS_FILTER'); ?>
			<?php
				echo LayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		</div>
	</div>
	
	<!-- The food list -->
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%">
				<?php echo Text::_('COM_EASYFPU_NUM'); ?>
			</th>
			<th width="2%">
				<?php echo HTMLHelper::_('grid.checkall'); ?>
			</th>
			<th width="95%">
				<?php echo HTMLHelper::_('grid.sort', 'COM_EASYFPU_EASYFPUS_NAME', 'name', $listDirn, $listOrder); ?>
			</th>
			<th width="2%">
				<?php echo HTMLHelper::_('grid.sort', 'COM_EASYFPU_ID', 'id', $listDirn, $listOrder); ?>
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
				<?php foreach ($this->items as $i => $row) :
				    $link = Route::_('index.php?option=com_easyfpu&task=easyfpu.edit&id=' . $row->id);
				?>
					<tr>
						<td>
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo HTMLHelper::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_EASYFPU_EDIT_EASYFPU'); ?>">
								<?php echo $row->name; ?>
							</a>
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
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo HTMLHelper::_('form.token'); ?>
</form>