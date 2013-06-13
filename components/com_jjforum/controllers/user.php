<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.controller');
jimport('joomla.plugin.helper');

class JjforumControllerUser extends JController
{
	/**
	 * Method to log in a user.
	 *
	 * @since	1.6
	 */
	public function login()
	{
	//	JRequest::checkToken('post') or jexit(JText::_('JInvalid_Token'));

		$app = JFactory::getApplication();

		// Populate the data array:
		$data = array();
		$data['return'] = base64_decode(JRequest::getVar('return', '', 'POST', 'BASE64'));
		$data['username'] = JRequest::getVar('username');
		$data['password'] = JRequest::getVar('password');

		// Set the return URL if empty.
		if (empty($data['return'])) {
			$data['return'] = 'index.php';
		}

		// Get the log in options.
		$options = array();
		$options['remember'] = JRequest::getBool('remember', false);
		$options['return'] = $data['return'];

		// Get the log in credentials.
		$credentials = array();
		$credentials['username'] = $data['username'];
		$credentials['password'] = $data['password'];

		// Perform the log in.
		$error = $app->login($credentials, $options);

		// Check if the log in succeeded.
		if (!JError::isError($error)) {
			$app->setUserState('users.login.form.data', array());
			$app->redirect(JRoute::_('components/com_jjforum/includes/login.php', false));
		} else {
			$data['remember'] = (int)$options['remember'];
			$app->setUserState('users.login.form.data', $data);
		//	JError::raiseError(500, 'wrong data');
		}
	}

	/**
	 * Method to log in a FAcebook user.
	 *
	 */
	public function fblogin()
	{
		$app = JFactory::getApplication();
		$db = JFactory::getDBO();
		// Populate the data array:
		$data = array();
		$data['email']      = JRequest::getVar('email');
		$data['username']   = 'FB_'.JRequest::getVar('user');
		$data['name']       = JRequest::getVar('name');
		$data['password']	= base64_encode(JRequest::getVar('user').'S~Alt');
		
		// Set the return URL if empty.
		if (empty($data['return'])) {
			$data['return'] = 'index.php';
		}

		//check if user exists already and if not create one
		$query	= $db->getQuery(true);
		$query = "SELECT * FROM #__users WHERE email = '".$data['email']."'";
		$db->setQuery($query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
		}
		if($db->loadResult() == 0){
		//create a new user with FB details
			 $this->register($data);
			 $app->redirect(JRoute::_('index.php?option=com_jjforum&view=posts&id=1', false));
		} else {
			// log the user in
			// Get the log in options.
			$options = array();
			$options['remember'] = JRequest::getBool('remember', false);
			$options['return'] = 'index.php';
	
			// Get the log in credentials.
			$credentials = array();
			$credentials['username'] = $data['username'];
			$credentials['password'] = $data['password'];
	
			// Perform the log in.
			$error = $app->login($credentials, $options);
	
			// Check if the log in succeeded.
			if (!JError::isError($error)) {
				$app->setUserState('users.login.form.data', array());
				$app->redirect(JRoute::_('index.php?option=com_jjforum&view=posts&id=1', false));
			} else {
				$data['remember'] = (int)$options['remember'];
				$app->setUserState('users.login.form.data', $data);
			//	JError::raiseError(500, 'wrong data');
			}
		}
	}


	/**
	 * Method to log out a user.
	 *
	 * @since	1.6
	 */
	public function logout()
	{
		JRequest::checkToken('default') or jexit(JText::_('JInvalid_Token'));

		$app = JFactory::getApplication();

		// Perform the log in.
		$error = $app->logout();

		// Check if the log out succeeded.
		if (!JError::isError($error)) {
			// Get the return url from the request and validate that it is internal.
			$return = JRequest::getVar('return', '', 'method', 'base64');
			$return = base64_decode($return);
			if (!JURI::isInternal($return)) {
				$return = '';
			}

			// Redirect the user.
		//	$app->redirect(JRoute::_($return, false));
		} //else {
		//	$app->redirect(JRoute::_('index.php?option=com_users&view=login', false));
		//}
	}


	public function register($data)
	{
		$data['groups'][] = '2';
		// Initialise the table with JUser.
		$user = new JUser;
		// Bind the data.
		if (!$user->bind($data)) {
			return $user->getError();
		}

		// Load the users plugin group.
		JPluginHelper::importPlugin('user');

		// Store the data.
		if (!$user->save()) {
			return $user->getError();
		}
		return $user->id;
	}
}