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
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Log\Log;

/**
 * EasyFPUs controller
 *
 * @since 0.0.1
 */
class EasyFPUControllerEasyFPUs extends AdminController {
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
    public function getModel($name = 'EasyFPUs', $prefix = 'EasyFPUModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
    
    public function new($key = null)
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Redirect to new food form
        $this->setRedirect(Route::_('index.php?option=com_easyfpu&view=easyfpu'));
    }

    public function export($key = null)
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
            
            // TODO Implement export
        }
    }
}
