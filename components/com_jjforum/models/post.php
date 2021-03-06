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
require (JPATH_BASE .DS.'components'.DS.'com_jjforum'.DS.'includes'.DS.'lib'.DS.'facebook.php');

JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_jjforum/tables');

/**
 * Model
 */
class JjforumModelPost extends JModel
{
	
	function &getItem()
	{
		$app		= JFactory::getApplication();
		$this->params		= $app->getParams();
		
		//set as optional
		$doc =& JFactory::getDocument();
		$doc->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js");
		$doc->addScript("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js");
		//include fancybox lightbox
		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/fancybox/jquery.fancybox-1.3.4.pack.js");
		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/includes/fancybox/jquery.fancybox-1.3.4.css");
		//include uploadify
		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/uploadify/jquery.uploadify.min.js");
		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/includes/uploadify/uploadify.css");
		//include tags
		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/tags/jquery.tokeninput.js");
		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/includes/tags/token-input.css");
		//include editor
		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/editor/jHtmlArea-0.7.0.min.js");
		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/includes/editor/jHtmlArea.css");
				
		//jjForum script
		$doc->addScript(JURI::base(true) . "/components/com_jjforum/includes/jjForum.js");
		$doc->addStyleSheet(JURI::base(true) . "/components/com_jjforum/templates/".$this->params->get('theme')."/style.css");
		
		//define the base url
		$doc->addScriptDeclaration('var jjForum_base = "' . JURI::base() . '";');

		$postid = JRequest::getVar('id');
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query = 'SELECT a.*, b.name as uname, b.id as uid ';
		$query .= 'FROM #__jjforum_post as a,#__users as b ';
		$query .= "WHERE a.id = $postid AND state = 1 AND level = 0 AND a.user_id = b.id ";

		$db->setQuery((string)$query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
		}
		$itemData = $db->loadObjectList();
		
		return $itemData;
	}

	function getCategory()
	{
		$catid = JRequest::getVar('id');
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select(
			'a.*'
			);
		$query->from('#__jjforum_category as a WHERE id = '.$catid.' ORDER BY ordering');

		$db->setQuery((string)$query);
		if (!$db->query()) {
			echo $db->getErrorMsg();
		}

		$this->cat = $db->loadObject();
		return $this->cat;
	}

	function getFbconnect(){
		$user	 = JFactory::getUser();
		$itemid = JRequest::getVar('Itemid');
		$facebook = new Facebook(array(
		  'appId'  => '351360998236172',
		  'secret' => 'bf35d853db4eff9791c890199c2f3c5b',
		));
			$FBlogin = '';	
		// See if there is a user from a cookie
		$FBuser = $facebook->getUser();
		if ($FBuser && $user->id == 0) {
		  try {
			// Proceed knowing you have a logged in user who's authenticated.
			$FBprofile = $facebook->api('/me');
			//	$app->redirect(JRoute::_('index.php?option=com_jjforum&view=user&task=user.fblogin&email='.$FBlogin['email'].'&user='.$FBlogin['id'].'&name='.$FBlogin['name'], false));
				$FBlogin = 'index.php?option=com_jjforum&view=user&task=user.fblogin&email='.$FBprofile['email'].'&user='.$FBprofile['id'].'&name='.$FBprofile['name'].'&Itemid='.$itemid;	
		  } catch (FacebookApiException $e) {
			$FBuser = null;
		  }
		
		} elseif ($FBuser && $user->id != 0){
			$FBprofile = $facebook->api('/me');
			$FBlogin = 'isuser-'.$FBprofile['id'];
		} else {
			$FBlogin = '<fb:login-button data-scope="email"></fb:login-button>';	
		}
		return $FBlogin;
	}

}

