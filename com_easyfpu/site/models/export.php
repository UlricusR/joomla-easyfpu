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
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Language\Text;

/**
 * Export Model
 *
 * @since  0.0.1
 */
class EasyFPUModelExport extends BaseDatabaseModel
{
    const DOWNLOAD_FOLDER_REL = 'components/com_easyfpu/downloads/';
    const JSON_FILE_NAME = 'fpu_calculator_database.json';
    
    /**
     * Constructor
     *
     * @param array $config
     */
    public function __construct($config = array()) {
        parent::__construct($config);
        
        $path = self::DOWNLOAD_FOLDER_REL;
        
        // Create download directory if necessary
        if (!Folder::exists($path)) {
            // Create directory and add an empty index.html to avoid direct access
            if (!(Folder::create($path, 0755) && File::write($path . 'index.html', '<html><body bgcolor="#FFFFFF"></body></html>'))) {
                Log::add(Text::_('COM_EASYFPU_ERROR_CANNOT_CREATE_FOLDER'), Log::ERROR, 'jerror');
                Factory::getApplication()->redirect(Route::_('index.php?option=com_easyfpu&view=easyfpus'));
            }
        }
    }
    
    public function getJsonFile()
    {
        // Get the ids
        $ids = $this->getState('ids');
        
        // Get the user
        $user = Factory::getUser();
        
        // Load the selected food items from the database
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')
            ->from($db->quoteName('#__easyfpu'))
            ->where('created_by = ' . $user->id)
            ->andWhere('id IN (' . implode(',', $ids) .')');
        $db->setQuery($query);
        $results = $db->loadObjectList();
        
        // Create the json object
        $foodItems = array();
        foreach ($results as $result) {
            $foodItem = array();
            $foodItem['name'] = $result->name;
            $foodItem['favorite'] = boolval($result->favorite);
            $foodItem['calories_per_100g'] = doubleval($result->calories);
            $foodItem['carbs_per_100g'] = doubleval($result->carbs);
            $foodItem['amount_small'] = intval($result->amount_small);
            $foodItem['amount_medium'] = intval($result->amount_medium);
            $foodItem['amount_large'] = intval($result->amount_large);
            $foodItem['comment_small'] = intval($result->comment_small);
            $foodItem['comment_medium'] = intval($result->comment_medium);
            $foodItem['comment_large'] = intval($result->comment_large);
            array_push($foodItems, $foodItem);
        }
        
        // JSON encode food items
        $jsonObject = '{ "food_items": ' . json_encode($foodItems, JSON_PRETTY_PRINT) . ' }';
        
        // Write file
        $file = self::DOWNLOAD_FOLDER_REL . $user->id . '/' . self::JSON_FILE_NAME;
        if (!File::write($file, $jsonObject)) {
            Log::add(Text::_('COM_EASYFPU_ERROR_CANNOT_CREATE_USERFILE'), Log::ERROR, 'jerror');
            Factory::getApplication()->redirect(Route::_('index.php?option=com_easyfpu&view=easyfpus'));
        } else {
            // Return file name
            return Uri::root() . $file;
        }
    }
}