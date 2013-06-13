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
class JjforumViewCategories extends JView
{
	protected $state;
	protected $item;
	protected $tags;

	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$this->params		= $app->getParams();

		// Get some data from the models
		$state		= $this->get('State');
		$this->item		= $this->get('Item');
		$this->items		= $this->get('Items');
		$this->tags		= $this->get('Tags');
		$this->count		= $this->get('CatItem');
	//	if ($item->params->get('theme')) {
			$this->_addPath('template', JPATH_COMPONENT.DS.'templates'.DS.'default'.DS.'categories');
			$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS.'com_k2'.DS.'templates'.DS.'default'.DS.'categories');
			$this->_addPath('template', JPATH_SITE.DS.'templates'.DS.$app->getTemplate().DS.'html'.DS.'com_k2'.DS.'default'.DS.'categories');
	//	}
		
        parent::display($tpl);

	}
}