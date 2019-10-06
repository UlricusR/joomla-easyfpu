<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\Easyfpu\Site\Controller;

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
class CalcmealController extends BaseController
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
    public function getModel($name = 'CalcMeal', $prefix = 'Site', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
    
    public function calcmeal($key = null)
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Get items to from the request
        $ids = explode(',', $this->input->getString('ids'));
        
        // Make sure they are integers
        $ids = ArrayHelper::toInteger($ids);
        
        // Retrieve amounts
        $amounts = array();
        foreach ($ids as $id) {
            $amount = $this->input->getInteger('amount' . $id);
            $amounts[$id] = $amount;
        }
        
        if ($view = $this->getView('CalcMeal', 'html', 'Site')) {    
            // Set to calcmeal model
            $model = $this->getModel();
            $model->setState('amounts', $amounts);
            $view->setModel($model, true);
            
            // Call view
            $view->display();
        }
    }
}