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
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Router\Route;
use Joomla\Utilities\ArrayHelper;

/**
 * Export Controller
 *
 * @since  0.0.1
 */
class EasyFPUModelCalcMeal extends BaseDatabaseModel
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
    public function getModel($name = 'Export', $prefix = 'EasyFPUModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
    
    public function export()
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Get items to use for new meal
        $cid = $this->input->get('cid', array(), 'array');
        
        if (!is_array($cid) || count($cid) < 1)
        {
            Log::add(\JText::_('COM_EASYFPU_NO_ITEM_SELECTED'), Log::WARNING, 'jerror');
            $this->setRedirect(Route::_('index.php?option=com_easyfpu&view=easyfpus'));
        }
        else
        {
            // Make sure the item ids are integers
            $cid = ArrayHelper::toInteger($cid);
            
            if ($view = $this->getView('Export', 'html', 'EasyFPUView')) {
                // Set to export model
                $model = $this->getModel();
                $model->setState('ids', $cid);
                $view->setModel($model, true);
                
                // Call view
                $view->display();
            }
        }
    }
}