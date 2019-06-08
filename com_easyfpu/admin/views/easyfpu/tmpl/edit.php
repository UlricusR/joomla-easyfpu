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
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;


HTMLHelper::_('behavior.formvalidator');

// The following is to enable setting the permission's Calculated Setting
// when you change the permission's Setting.
// The core javascript code for initiating the Ajax request looks for a field
// with id="jform_title" and sets its value as the 'title' parameter to send in the Ajax request
Factory::getDocument()->addScriptDeclaration('
	jQuery(document).ready(function() {
        name = jQuery("#jform_name").val();
		jQuery("#jform_title").val(name);
	});
');

?>
<form action="<?php echo Route::_('index.php?option=com_easyfpu&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
    
    <input id="jform_title" type="hidden" name="easyfpu-fooditem-title"/>
    
    <div class="form-horizontal">
    	<?php echo HTMLHelper::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
    	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'details', 
            empty($this->item->id) ? JText::_('COM_EASYFPU_TAB_NEW_FOODITEM') : JText::_('COM_EASYFPU_TAB_EDIT_FOODITEM')); ?>
        	<fieldset class="adminform">
            	<legend><?php echo JText::_('COM_EASYFPU_LEGEND_DETAILS') ?></legend>
            	<div class="row-fluid">
                	<div class="span6">
                    	<?php echo $this->form->renderFieldset('details');  ?>
                	</div>
            	</div>
        	</fieldset>
    	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

    	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'params', JText::_('COM_EASYFPU_TAB_PARAMS')); ?>
        	<fieldset class="adminform">
            	<legend><?php echo JText::_('COM_EASYFPU_LEGEND_PARAMS') ?></legend>
            	<div class="row-fluid">
                	<div class="span6">
                    	<?php echo $this->form->renderFieldset('params');  ?>
                	</div>
            	</div>
        	</fieldset>
    	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>

    	<?php echo HTMLHelper::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_EASYFPU_TAB_PERMISSIONS')); ?>
        	<fieldset class="adminform">
            	<legend><?php echo JText::_('COM_EASYFPU_LEGEND_PERMISSIONS') ?></legend>
            	<div class="row-fluid">
                	<div class="span12">
                    	<?php echo $this->form->renderFieldset('accesscontrol');  ?>
                	</div>
            	</div>
        	</fieldset>
    	<?php echo HTMLHelper::_('bootstrap.endTab'); ?>
    	<?php echo HTMLHelper::_('bootstrap.endTabSet'); ?>
    </div>
    <input type="hidden" name="task" value="easyfpu.edit" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>