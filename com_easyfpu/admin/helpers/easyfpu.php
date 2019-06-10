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
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

/**
 * EasyFPU component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class EasyFPUHelper extends ContentHelper
{
    /**
     * Configure the Linkbar.
     *
     * @return Bool
     */
    
    public static function addSubmenu($submenu)
    {
        JHtmlSidebar::addEntry(
            Text::_('COM_EASYFPU_SUBMENU_FOODITEMS'),
            'index.php?option=com_easyfpu',
            $submenu == 'easyfpus'
            );
        
        JHtmlSidebar::addEntry(
            Text::_('COM_EASYFPU_SUBMENU_CATEGORIES'),
            'index.php?option=com_categories&view=categories&extension=com_easyfpu',
            $submenu == 'categories'
            );
        
        // Set some global property
        $document = Factory::getDocument();
        $document->addStyleDeclaration('.icon-48-easyfpu ' .
            '{background-image: url(../media/com_easyfpu/images/easyfpu-48x48.png);}');
        if ($submenu == 'categories')
        {
            $document->setTitle(Text::_('COM_EASYFPU_ADMINISTRATION_CATEGORIES'));
        }
    }
}