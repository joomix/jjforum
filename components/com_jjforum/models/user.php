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

jimport('joomla.application.component.model');
jimport('joomla.application.component.helper');

JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_jjforum/tables');

/**
 * Model
 */
class JjforumModelUser extends JModel
{
	protected $_item;

	/**
	 * Get the data for a banner
	 */
	function &getItem()
	{
//		$app		= JFactory::getApplication();
//		$this->params		= $app->getParams();
//		
//		//set as optional
//		$doc =& JFactory::getDocument();
//		$doc->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js");
//		$doc->addScript("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js");
//		//include fancybox lightbox
//		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/fancybox/jquery.fancybox-1.3.4.pack.js");
//		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/includes/fancybox/jquery.fancybox-1.3.4.css");
//		//include uploadify
//		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/uploadify/jquery.uploadify.v2.1.4.min.js");
//		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/uploadify/swfobject.js");
//		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/includes/uploadify/uploadify.css");
//		//jjForum script
//		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/jjForum.js");
//		//define the base url
//		$doc->addScriptDeclaration('var jjForum_base = "' . JURI::base() . '";');
//		return $this->_item;
	}


}

