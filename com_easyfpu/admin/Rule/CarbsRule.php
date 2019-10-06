<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Administrator\Rule;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Form\FormRule;
use Joomla\Registry\Registry;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use SimpleXMLElement;

/**
 * Form Rule class for the Joomla Framework.
 */
class CarbsRule extends FormRule
{
    public function test(SimpleXMLElement $element, $value, $group = null, Registry $input = null, Form $form = null)
    {
        // Check if value is numeric
        if (!is_numeric($value)) {
            $element->attributes()->message = Text::_('COM_EASYFPU_EASYFPU_ERRMSG_NUMBER_FRAC');
            return false;
        }
        
        // Check if calories from carbs do not exceed total calories (1g carbs has 4 kcal)
        $caloriesFromCarbs = $value * 4;
        $totalCalories = $input->get('calories', 0);
        
        if ($caloriesFromCarbs > $totalCalories) {
            $element->attributes()->message = Text::_('COM_EASYFPU_EASYFPU_ERRMSG_TOOMUCHCARBS');
            return false;
        }
        
        return true;
    }
}