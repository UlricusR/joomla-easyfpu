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
use Joomla\CMS\Factory;

/**
 * EasyFPU model
 * 
 * @since 0.0.1
 */
class EasyFPUModelEasyFPU extends JModelItem {
    /**
     * @var object item
     */
    protected $item;
    
    /**
     * Method to auto-populate the model state.
     *
     * This method should only be called once per instantiation and is designed
     * to be called on the first call to the getState() method unless the model
     * configuration flag to ignore the request is set.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return	void
     * @since	2.5
     */
    protected function populateState()
    {
        // Get the message id
        $jinput = Factory::getApplication()->input;
        $id     = $jinput->get('id', 1, 'INT');
        $this->setState('message.id', $id);
        
        // Load the parameters.
        $this->setState('params', Factory::getApplication()->getParams());
        parent::populateState();
    }
    
    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $type    The table name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   0.0.1
     */
    public function getTable($type = 'EasyFPU', $prefix = 'EasyFPUTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    /**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	public function getItem()
	{
		if (!isset($this->item)) 
		{
			$id    = $this->getState('fooditem.id');
			$db    = Factory::getDbo();
			$query = $db->getQuery(true);
			$query->select('h.name, h.params, c.title as category')
				  ->from('#__easyfpu as h')
				  ->leftJoin('#__categories as c ON h.catid=c.id')
				  ->where('h.id=' . (int)$id);
			$db->setQuery((string)$query);
		
			if ($this->item = $db->loadObject()) 
			{
				// Load the JSON string
				$params = new JRegistry;
				$params->loadString($this->item->params, 'JSON');
				$this->item->params = $params;

				// Merge global params with item params
				$params = clone $this->getState('params');
				$params->merge($this->item->params);
				$this->item->params = $params;
			}
		}
		return $this->item;
	}
}