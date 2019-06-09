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
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Application\WebApplication;
use Joomla\CMS\Router\Route;

/**
 * Export Model
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
    
    public function export($key = null)
    {
            // Generate JSON file
            $json_array = generateJson($cid);
            
            // Get the document object.
            $document = Factory::getDocument();

            // TODO Implement
            
            // Output the JSON data.
            echo json_encode($json_array);
        }
    }
    
    private function generateJson($ids) {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select();
    }
    
}