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
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

HTMLHelper::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
?>
<form action="<?php Route::_('index.php?option=com_easyfpu&view=easyfpus'); ?>" method="post" id="adminForm" name="adminForm">
	<div id="j-main-container" class="span10">
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
    	<table class="table table-striped table-hover">
    		<thead>
    		<tr>
    			<th width="1%"><?php echo Text::_('COM_EASYFPU_NUM'); ?></th>
    			<th width="2%">
    				<?php echo HTMLHelper::_('grid.checkall'); ?>
    			</th>
    			<th width="30%">
    				<?php echo HTMLHelper::_('searchtools.sort', 'COM_EASYFPU_EASYFPUS_NAME', 'name', $listDirn, $listOrder); ?>
    			</th>
    			<th width="30%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_EASYFPU_AUTHOR', 'author', $listDirn, $listOrder); ?>
                </th>
                <th width="30%">
                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_EASYFPU_CREATED_DATE', 'created', $listDirn, $listOrder); ?>
                </th>
    			<th width="5%">
    				<?php echo HTMLHelper::_('searchtools.sort', 'COM_EASYFPU_PUBLISHED', 'published', $listDirn, $listOrder); ?>
    			</th>
    			<th width="2%">
    				<?php echo HTMLHelper::_('searchtools.sort', 'COM_EASYFPU_ID', 'id', $listDirn, $listOrder); ?>
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
    							<a href="<?php echo $link; ?>" title="<?php echo Text::_('COM_EASYFPU_EDIT_EASYFPU'); ?>">
    								<?php echo $row->name; ?>
    							</a>
    						</td>
    						<td align="center">
                                <?php echo $row->author; ?>
                            </td>
                            <td align="center">
                                <?php echo substr($row->created, 0, 10); ?>
                            </td>
    						<td align="center">
    							<?php echo HTMLHelper::_('jgrid.published', $row->published, $i, 'easyfpus.', true, 'cb'); ?>
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
        <?php echo HTMLHelper::_('form.token'); ?>
    </div>
</form>