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

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_easyfpu&view=easyfpus" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
    	<div class="row-fluid">
    		<div class="span6">
    			<?php echo JText::_('COM_EASYFPU_EASYFPUS_FILTER'); ?>
    			<?php
    				echo JLayoutHelper::render(
    					'joomla.searchtools.default',
    					array('view' => $this)
    				);
    			?>
    		</div>
    	</div>
    	<table class="table table-striped table-hover">
    		<thead>
    		<tr>
    			<th width="1%"><?php echo JText::_('COM_EASYFPU_NUM'); ?></th>
    			<th width="2%">
    				<?php echo JHtml::_('grid.checkall'); ?>
    			</th>
    			<th width="90%">
    				<?php echo JHtml::_('grid.sort', 'COM_EASYFPU_EASYFPUS_NAME', 'greeting', $listDirn, $listOrder); ?>
    			</th>
    			<th width="5%">
    				<?php echo JHtml::_('grid.sort', 'COM_EASYFPU_PUBLISHED', 'published', $listDirn, $listOrder); ?>
    			</th>
    			<th width="2%">
    				<?php echo JHtml::_('grid.sort', 'COM_EASYFPU_ID', 'id', $listDirn, $listOrder); ?>
    			</th>
    		</tr>
    		</thead>
    		<tfoot>
    			<tr>
    				<td colspan="5">
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
    							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
    						</td>
    						<td>
    							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_EASYFPU_EDIT_EASYFPU'); ?>">
    								<?php echo $row->greeting; ?>
    							</a>
    							<div class="small">
									<?php echo JText::_('JCATEGORY') . ': ' . $this->escape($row->category_title); ?>
								</div>
    						</td>
    						<td align="center">
    							<?php echo JHtml::_('jgrid.published', $row->published, $i, 'easyfpus.', true, 'cb'); ?>
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
    	<?php echo JHtml::_('form.token'); ?>
    </div>
</form>