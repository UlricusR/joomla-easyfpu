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
use Joomla\CMS\MVC\Controller\FormController;

/**
 * EasyFPU Controller
 *
 * @package     Joomla.Site
 * @subpackage  com_easyfpu
 *
 * Used to handle the http POST from the front-end form which allows
 * users to enter a new easyfpu fooditem
 *
 */
class EasyFPUControllerEasyFPU extends FormController
{
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
    
    public function cancel($key = null)
    {
        parent::cancel($key);
        
        // set up the redirect back to the same form
        $this->setRedirect(
            JRoute::_('index.php?option=com_easyfpu&view=easyfpus'),
            JText::_('COM_EASYFPU_ADD_CANCELLED')
        );
    }
    
    /*
     * Function handing the save for adding a new easyfpu record
     * Based on the save() function in the JControllerForm class
     */
    public function save($key = null, $urlVar = null)
    {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        $app = Factory::getApplication();
        $input = $app->input;
        $model = $this->getModel('easyfpu');
        
        // Get the current URI to set in redirects. As we're handling a POST,
        // this URI comes from the <form action="..."> attribute in the layout file above
        $currentUri = (string)JUri::getInstance();
        $redirectUri = JRoute::_('index.php?option=com_easyfpu&view=easyfpus');
        
        // Check that this user is allowed to add a new record
        if (!Factory::getUser()->authorise( "core.create", "com_easyfpu"))
        {
            $app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
            $app->setHeader('status', 403, true);
            
            return;
        }
        
        // get the data from the HTTP POST request
        $data  = $input->get('jform', array(), 'array');
        
        // set up context for saving form data
        $context = "$this->option.edit.$this->context";
        
        // Validate the posted data.
        // First we need to set up an instance of the form ...
        $form = $model->getForm($data, false);
        
        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }
        
        // ... and then we validate the data against it
        // The validate function called below results in the running of the validate="..." routines
        // specified against the fields in the form xml file, and also filters the data
        // according to the filter="..." specified in the same place (removing html tags by default in strings)
        $validData = $model->validate($form, $data);
        
        // Handle the case where there are validation errors
        if ($validData === false)
        {
            // Get the validation messages.
            $errors = $model->getErrors();
            
            // Display up to three validation messages to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
            {
                if ($errors[$i] instanceof Exception)
                {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                }
                else
                {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }
            
            // Save the form data in the session.
            $app->setUserState($context . '.data', $data);
            
            // Redirect back to the same screen.
            $this->setRedirect($currentUri);
            
            return false;
        }
        
        // add the 'created by' and 'created' date fields
        $validData['created_by'] = Factory::getUser()->get('id', 0);
        $validData['created'] = date('Y-m-d h:i:s');
        
        // Attempt to save the data.
        if (!$model->save($validData))
        {
            // Handle the case where the save failed
            
            // Save the data in the session.
            $app->setUserState($context . '.data', $validData);
            
            // Redirect back to the edit screen.
            $this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');
            
            $this->setRedirect($currentUri);
            
            return false;
        }
        
        // clear the data in the form
        $app->setUserState($context . '.data', null);
        
        $this->setRedirect(
            $redirectUri,
            JText::_('COM_EASYFPU_ADD_SUCCESSFUL')
        );
        
        return true;
    }
    
}