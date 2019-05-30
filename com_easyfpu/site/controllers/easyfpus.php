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
    public function getModel($name = 'EasyFPU', $prefix = 'EasyFPUModel', $config = array('ignore_request' => true))
    {
        $model = parent::getModel($name, $prefix, $config);
        
        return $model;
    }
    
    public function new($key = null)
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Redirect to new food form
        $this->setRedirect(\JRoute::_('index.php?option=com_easyfpu&view=easyfpu&layout=edit'));
    }
    
    public function newmeal($key = null)
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Get items to remove from the request.
        $cid = $this->input->get('cid', array(), 'array');
        
        if (!is_array($cid) || count($cid) < 1)
        {
            \JLog::add(\JText::_('COM_EASYFPU_NO_ITEM_SELECTED'), \JLog::WARNING, 'jerror');
            $this->setRedirect(\JRoute::_('index.php?option=com_easyfpu&view=easyfpus'));
        }
        else
        {
            // Make sure the item ids are integers
            $cid = ArrayHelper::toInteger($cid);
            
            // Set the values
            $this->input->set('ids', implode(',', $cid));
            
            // Call new meal, passing the ids
            $this->setRedirect(\JRoute::_('index.php?option=com_easyfpu&view=newmeal&ids=' . implode(',', $cid)));
        }
    }
}
