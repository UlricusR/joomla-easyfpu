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

// TODO Adapt!

// Imports
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\MVC\Controller\BaseController;

/**
 * CalcMeal Controller
 *
 * @package     Joomla.Site
 * @subpackage  com_easyfpu
 *
 * Used to handle the http POST from the front-end form which allows
 * users to enter a new easyfpu fooditem
 *
 */
class EasyFPUControllerCalcMeal extends BaseController
{
    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.
     *
     * @since   1.6
     */
    public function getModel($name = 'CalcMeal', $prefix = 'EasyFPUModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
    
    public function calcmeal($key = null)
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Get items to remove from the request.
        $ids = explode(',', $this->input->getString('ids'));
        
        // Make sure they are integers
        $ids = ArrayHelper::toInteger($ids);
        
        // Retrieve amounts
        $amounts = array();
        foreach ($ids as $id) {
            $amount = $this->input->getInteger('amount' . $id);
            $amounts[$id] = $amount;
        }
        
        // Set to calcmeal model
        //$this->getModel()->amounts = $amounts;
        $this->getModel()->setState('amounts', $amounts);
        
        // Call calc meal
        $this->setRedirect(\JRoute::_('index.php?option=com_easyfpu&view=calcmeal'));
    }
}