<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\EasyFPU\Site\Table;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Table\Table;
use Joomla\Registry\Registry;
use Joomla\CMS\Access\Rules;

/**
 * FPU Table class
 *
 * @since  0.0.1
 */
class EasyFPUTable extends Table {
    /**
     * Constructor
     * 
     * @param JDatabaseDriver &$db A database connector object
     */
    function __construct(&$db) {
        parent::__construct('#__easyfpu', 'id', $db);
    }
    
    /**
     * Overloaded bind function
     *
     * @param       array           named array
     * @return      null|string     null is operation was satisfactory, otherwise returns an error
     * @see JTable:bind
     * @since 1.5
     */
    public function bind($array, $ignore = '')
    {
        if (isset($array['params']) && is_array($array['params'])) {
            // Convert the params field to a string.
            $parameter = new Registry();
            $parameter->loadArray($array['params']);
            $array['params'] = (string)$parameter;
        }
        
        // Bind the rules.
        if (isset($array['rules']) && is_array($array['rules'])) {
            $rules = new Rules($array['rules']);
            $this->setRules($rules);
        }
        
        return parent::bind($array, $ignore);
    }
    
    /**
     * Method to compute the default name of the asset.
     * The default name is in the form `table_name.id`
     * where id is the value of the primary key of the table.
     *
     * @return	string
     * @since	2.5
     */
    protected function _getAssetName() {
        $k = $this->_tbl_key;
        return 'com_easyfpu.easyfpu.'.(int) $this->$k;
    }
    
    /**
     * Method to return the title to use for the asset table.
     *
     * @return	string
     * @since	2.5
     */
    protected function _getAssetTitle() {
        return $this->name;
    }
    
    /**
     * Method to get the asset-parent-id of the item
     *
     * @return	int
     */
    protected function _getAssetParentId(Table $table = NULL, $id = NULL) {
        // We will retrieve the parent-asset from the Asset-table
        $assetParent = Table::getInstance('Asset');
        // Default: if no asset-parent can be found we take the global asset
        $assetParentId = $assetParent->getRootId();
        
        // Find the parent-asset
        // The item has the component as asset-parent
        $assetParent->loadByName('com_easyfpu');
        
        // Return the found asset-parent-id
        if ($assetParent->id)
        {
            $assetParentId=$assetParent->id;
        }
        return $assetParentId;
    }
}