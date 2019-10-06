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

// Imports
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Router\Route;

/**
 * Easyfpus controller
 *
 * @since 0.0.1
 */
class EasyfpusController extends AdminController {
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
    public function getModel($name = 'Easyfpus', $prefix = 'Site', $config = array('ignore_request' => true))
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

    public function easyfpus($key = null)
    {
        // Check for request forgeries
        $this->checkToken();
        
        // Redirect to easyfpus form
        $this->setRedirect(Route::_('index.php?option=com_easyfpu&view=easyfpus'));
    }
}
