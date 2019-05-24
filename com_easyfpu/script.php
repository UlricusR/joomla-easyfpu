<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access to this file
defined('_JEXEC') or die;

/**
 * Script file of EasyFPU component.
 *
 * The name of this class is dependent on the component being installed.
 * The class name should have the component's name, directly followed by
 * the text InstallerScript (ex:. com_easyFPUInstallerScript).
 *
 * This class will be called by Joomla!'s installer, if specified in your component's
 * manifest file, and is used for custom automation actions in its installation process.
 *
 * In order to use this automation script, you should reference it in your component's
 * manifest file as follows:
 * <scriptfile>script.php</scriptfile>
 *
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
class mod_easyFPUInstallerScript
{
	/**
     * This method is called after a component is installed.
     *
     * @param  \stdClass $parent - Parent object calling this method.
     *
     * @return void
     */
	function install($parent) {
	    $parent->getParent()->setRedirectURL('index.php?option=com_easyfpu');
	}

	/**
     * This method is called after a component is uninstalled.
     *
     * @param  \stdClass $parent - Parent object calling this method.
     *
     * @return void
     */
	function uninstall($parent) {
	    echo '<p>' . JText::_('COM_EASYFPU_UNINSTALL_TEXT') . '</p>';
	}

	/**
     * This method is called after a component is updated.
     *
     * @param  \stdClass $parent - Parent object calling object.
     *
     * @return void
     */
	function update($parent) {
	    echo '<p>' . JText::sprintf('COM_EASYFPU_UPDATE_TEXT', $parent->manifest->version) . '</p>';
	}

	/**
     * Runs just before any installation action is preformed on the component.
     * Verifications and pre-requisites should run in this function.
     *
     * @param  string    $type   - Type of PreFlight action. Possible values are:
     *                           - * install
     *                           - * update
     *                           - * discover_install
     * @param  \stdClass $parent - Parent object calling object.
     *
     * @return void
     */
	function preflight($type, $parent) {
	    echo '<p>' . JText::_('COM_EASYFPU_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	/**
     * Runs right after any installation action is preformed on the component.
     *
     * @param  string    $type   - Type of PostFlight action. Possible values are:
     *                           - * install
     *                           - * update
     *                           - * discover_install
     * @param  \stdClass $parent - Parent object calling object.
     *
     * @return void
     */
	function postflight($type, $parent) {
	    echo '<p>' . JText::_('COM_EASYFPU_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}