<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * HTML View class for the Jjforum component
 */
class JjforumViewUser extends JView
{
	protected $state;
	protected $item;

	function display($tpl = null)
	{
	//	$this->params		= $app->getParams();
		// Get some data from the models
		$state		= $this->get('State');
        parent::display($tpl);

	}	
}