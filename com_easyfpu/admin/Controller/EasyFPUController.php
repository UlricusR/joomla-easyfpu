<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_easyfpu
 *
 * @copyright   Copyright (C) 2019 Ulrich Rueth. All rights reserved.
 * @license     GNU General Public License version 3 or later
 */

namespace RuethInfo\Component\EasyFPU\Administrator\Controller;

// No direct access
defined('_JEXEC') or die;

// Imports
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\FormController;

/**
 * EasyFPU controller
 * 
 * @package Joomla.Administrator
 * @subpackage com_easyfpu
 * @since 0.0.9
 */
class EasyFPUController extends FormController {
    /**
     * Implement to allowAdd or not
     *
     * Not used at this time (but you can look at how other components use it....)
     * Overwrites: JControllerForm::allowAdd
     *
     * @param array $data
     * @return bool
     */
    protected function allowAdd($data = array()) {
        return parent::allowAdd($data);
    }
    
    /**
     * Implement to allow edit or not
     * Overwrites: JControllerForm::allowEdit
     *
     * @param array $data
     * @param string $key
     * @return bool
     */
    protected function allowEdit($data = array(), $key = 'id') {
        $id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
        if( !empty( $id ) )
        {
            return Factory::getUser()->authorise( "core.edit", "com_easyfpu.easyfpu." . $id );
        }
    }
}