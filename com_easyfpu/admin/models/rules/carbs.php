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

/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleCarbs extends JFormRule
{
    public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
    {
        // Check if value is numeric
        if (!is_numeric($value)) {
            $element->attributes()->message = JText::_('COM_EASYFPU_EASYFPU_ERRMSG_NUMBER_FRAC');
            return false;
        }
        
        // Check if calories from carbs do not exceed total calories (1g carbs has 4 kcal)
        $caloriesFromCarbs = $value * 4;
        $totalCalories = $form->getValue('calories');
        
        if ($caloriesFromCarbs > $totalCalories) {
            $element->attributes()->message = JText::_('COM_EASYFPU_EASYFPU_ERRMSG_TOOMUCHCARBS');
            return false;
        }
        
        return true;
    }
}