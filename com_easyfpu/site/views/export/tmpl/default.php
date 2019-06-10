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
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

?>
<form action="<?php Route::_('index.php?option=com_easyfpu&view=easyfpus'); ?>" method="post" id="adminForm" name="adminForm">
	<p><a href="<?php echo $this->jsonFile; ?>"><?php echo Text::_('COM_EASYFPU_DOWNLOAD_JSON_FILE'); ?></a></p>

	<!-- The toolbar -->
	<div class="btn-toolbar">
		<div class="btn-group">
			<button type="submit" class="btn btn-success">
				<span class="icon-ok"></span><?php echo Text::_('COM_EASYFPU_DOWNLOAD_DONE') ?>
			</button>
		</div>
	</div>
</form>



