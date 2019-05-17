<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth, Inc. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

// No direct access
defined('_JEXEC') or die;

/**
 * FPU Table class
 *
 * @since  0.0.1
 */
class EasyFPUTableEasyFPU extends JTable {
    /**
     * Constructor
     * 
     * @param JDatabaseDriver &$db A database connector object
     */
    function __construct(&$db) {
        parent::__construct('#__easyfpu', 'id', $db);
    }
}