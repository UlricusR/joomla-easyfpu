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
use Joomla\CMS\Form\FormRule;

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleNumfracpos extends FormRule
{
    /**
     * The regular expression.
     *
     * @access	protected
     * @var		string
     * @since	2.5
     */
    protected $regex = '^(0|[1-9]\d*)(\.\d+)?$';
}