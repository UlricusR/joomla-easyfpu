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

JHtml::_('behavior.formvalidator');

?>
<form action="<?php echo JRoute::_('index.php?option=com_easyfpu&view=form&layout=edit'); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">

	<div class="form-horizontal">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_EASYFPU_LEGEND_DETAILS') ?></legend>
			<div class="row-fluid">
				<div class="span6">
					<?php echo $this->form->renderFieldset('details');  ?>
				</div>
			</div>
		</fieldset>
	</div>
    
	<div class="btn-toolbar">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('easyfpu.save')">
				<span class="icon-ok"></span><?php echo JText::_('JSAVE') ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn" onclick="Joomla.submitbutton('easyfpu.cancel')">
				<span class="icon-cancel"></span><?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
	</div>

	<input type="hidden" name="task" />
	<?php echo JHtml::_('form.token'); ?>
</form>