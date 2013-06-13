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
class JjforumModelCategories extends JModel
{
	protected $_item;

	/**
	 * Get the data for a banner
	 */
	function &getItem()
	{
		$doc =& JFactory::getDocument();
		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/templates/default/style.css");
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select(
			'a.*'
			);
		$query->from('#__jjforum_category as a ORDER BY ordering');

		$db->setQuery((string)$query);
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
		}

		$this->item = $db->loadObjectList();
		return $this->item;
	}

	function getCatItem()
	{
		$db		= $this->getDbo();
		$db->setQuery('SELECT COUNT(catid) as count, catid FROM #__jjforum_post WHERE level = 0 GROUP BY catid');
		if (!$db->query()) {
			echo $db->getErrorMsg();
		}

		$this->_item = $db->loadObjectList();
		return $this->_item;
	}

	function getItems()
	{
		$app		= JFactory::getApplication();
		$this->params		= $app->getParams();
		
		$catid = JRequest::getVar('id');
		if($catid){
			$db		= $this->getDbo();
			$query	= $db->getQuery(true);
			$query->select(
				'a.*, b.name as uname'
				);
			$query->from("#__jjforum_post as a,#__users as b");
			$query->where("a.catid = $catid AND state = 1 AND level = 0 AND a.user_id = b.id ORDER BY created_date DESC LIMIT 0,6");
	
			$db->setQuery((string)$query);
			if (!$db->query()) {
				echo $db->getErrorMsg();
			}
	
			$items = $db->loadObjectList();
			return $items;
		}
	}

	function getTags()
	{
		$app		= JFactory::getApplication();
		$this->params		= $app->getParams();
		
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select(
			'COUNT(a.tagID) as tags, a.tagID, b.name'
			);
		$query->from("#__jjforum_tags_xref as a,#__jjforum_tags as b");
		$query->where("a.tagID = b.id GROUP BY a.tagID ORDER BY tags DESC LIMIT 0,6");

		$db->setQuery((string)$query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
		}

		$items = $db->loadObjectList();
		return $items;
	}

}
