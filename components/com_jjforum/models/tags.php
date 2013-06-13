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
//jimport('joomla.filesystem.file');
//include(JPATH_SITE . DS . 'components' . DS . 'com_jjforum' . DS . 'includes' . DS . 'class.upload.php');

JTable::addIncludePath(JPATH_ROOT . '/administrator/components/com_jjforum/tables');

/**
 * Model
 */
class JjforumModelTags extends JModel
{

	/**
	 * Get the data for a banner
	 */
	function &getItem()
	{
		$app		= JFactory::getApplication();
		$this->params		= $app->getParams();
		$db		= $this->getDbo();
		
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
		
		//get tag id from DB
		$tag = JRequest::getVar('tag');
		$limit	= $this->params->get('limit', 8); 
		$order	= (JRequest::getVar('order')) ? JRequest::getVar('order') : $this->params->get('order', 'votes');
		$limitstart	= JRequest::getVar('limitstart', 0, '', 'int');
		$item =new JObject();
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		$query->select('id');
		$query->from("#__jjforum_tags ");
		$query->where("name = '".$tag."' AND state = 1");
		$db->setQuery((string)$query);
		$tagID = $db->loadResult();
		if(!empty($tagID)){
			$query	= $db->getQuery(true);
			$query = 'SELECT SQL_CALC_FOUND_ROWS a.*, b.name as uname, b.id as uid, c.title as category ';
			$query .= 'FROM #__jjforum_post as a,#__users as b ,#__jjforum_category as c ';
			$query .= "WHERE a.id IN (SELECT itemID FROM #__jjforum_tags_xref WHERE tagID = $tagID) AND a.state = 1 AND a.level = 0 AND a.user_id = b.id AND a.catid = c.id ";
			switch ($order){
				case 'newest':
					$query .= 'ORDER BY created_date DESC ';
					break;
				case 'oldest':
					$query .= 'ORDER BY created_date ASC ';
					break;
				case 'rating':
					$query .= 'ORDER BY votes DESC ';
					break;
				case 'default':
					$query .= 'ORDER BY pid DESC ';
					break;
			}
			$query .= "LIMIT $limitstart ,$limit";
	
			$db->setQuery((string)$query);
			if (!$db->query()) {
				echo $db->getErrorMsg();
			//	return;
			}
			$itemData = $db->loadObjectList();
			$db->setQuery('SELECT FOUND_ROWS();'); 
			jimport('joomla.html.pagination');
			$pageNav = new JPagination( $db->loadResult(), $limitstart ,$limit );
			$item->paging = $pageNav->getPagesLinks(); 
			$item->data = $itemData; 
		} else {
			$item = 0;
		}
		
		return $item;
	}

	function newreply(){
		$app =& JFactory::getApplication(); 
		$post    = JRequest::getVar('jjForum', array(), 'post', 'array'); 
		
		$user	 = JFactory::getUser();
		$userId	 = $user->get('id');

		$params = explode('-',$post['JJparams']);
		
		if ($post) {
			//get the posted data
						
			$db = JFactory::getDBO();
			$data =new JObject();
			if($post['JJquote'] == 1){
				$db->setQuery('SELECT text FROM #__jjforum_post WHERE id ='.$params[1]); 
				$postTxt = $db->loadResult();
				$text = '<div class="JJquote">'.$postTxt.'</div>'.$post['JJpost'];	
			} else {
				$text = $post['JJpost'];
			}
			
			$data->ordering =                     0;
			$data->state =                        1;
			$data->checked_out =                  0;
			$data->checked_out_time =             '0000-00-00 00:00:00';
			$data->catid =                        $params[0];
			$data->pid =                          $params[1];
			$data->title =                        $post['JJtopic'];
			$data->text =                         $text;
			$data->tags =                         $post['JJtags'];
			$data->user_id =                      $userId;
			$data->level =                        $params[2] + 1;
			$data->created_date =                 date('Y-m-d H:i:s');
			//get the next ID from the table
			$query = 'SELECT MAX(id) FROM #__jjforum_post';
			$db->setQuery($query);
			$nextId = $db->loadResult() + 1;
			$data->id = NULL;
			$ret = $db->insertObject('#__jjforum_post', $data, 'id');
			$db->setQuery('SELECT LAST_INSERT_ID() FROM #__jjforum_post'); 
			$postId = $db->loadResult();
			//update tags tables
			$this->addTags($postId, $post['JJtags']);

			if (!$ret) {
				echo $db->getErrorMsg();
				return false;
			}
			$this->notifyUser($data->level,$data->pid,$data->user_id,$data->notify,$data->title,$postId);
			$this->setRedirect(JRoute::_('components/com_jjforum/includes/newreply.php?postid='.$postId, false));
		} 
	}

	function removepost(){
			$postid    = JRequest::getVar('postid'); 
			$user	 = JFactory::getUser();
			$postid = str_replace('JJremove-', '', $postid);
			$post->id = $postid;
			$post->state = '-2';
			if ($postid && $user->authorise('core.admin','com_jjforum')) {
				$db = JFactory::getDBO();				
				$ret = $db->updateObject('#__jjforum_post', $post, 'id', false);
	
				if (!$ret) {
					echo $db->getErrorMsg();
					return false;
				}
			} 
		}

	protected function addTags($itemid, $tags){
		$db = JFactory::getDBO();
		$tags = explode(',',$tags);
		foreach($tags as $tag){
			$db->setQuery('SELECT id FROM #__jjforum_tags WHERE name = "'.$tag.'"');
			$extag = $db->loadResult();
			if(!is_null($extag)){
				$data =new JObject();
				$data->tagID = $extag;
				$data->itemID = $itemid;
				$ret = $db->insertObject('#__jjforum_tags_xref', $data, 'id');
			} else {
				$data =new JObject();
				$data->name = $tag;
				$ret = $db->insertObject('#__jjforum_tags', $data, 'id');

				$db->setQuery('SELECT LAST_INSERT_ID() FROM #__jjforum_tags'); 
				$lastId = $db->loadResult();
				
				$data =new JObject();
				$data->tagID = $lastId;
				$data->itemID = $itemid;
				$ret = $db->insertObject('#__jjforum_tags_xref', $data, 'id');
			}
		}
	}
	
	protected function notifyUser($level,$pid,$userid,$notify,$title, $postid){
		if($level == 0){
			if($notify == 1)
				$this->emailUser($userid,$title);
			else
				return false;
		} else {
			$this->getParent($pid);
		}
	}
	
	protected function getParent($pid){
		$db = JFactory::getDBO();
		$db->setQuery('SELECT * FROM #__jjforum_post WHERE id = '.$pid); 
		$postObj = $db->loadObject();
		$this->notifyUser($postObj->level,$postObj->pid,$postObj->user_id,$postObj->notify,$postObj->title,$postObj->id);
	}

	protected function emailUser($userid,$title, $postid){
		//send email
		$mailer =& JFactory::getMailer();
		$config =& JFactory::getConfig();
		$sender = array( 
			$config->getValue( 'config.mailfrom' ),
			$config->getValue( 'config.fromname' ) );
		$postLink = JRoute::_(JURI::base().'index.php?option=com_jjforum&view=post&id='.$postid);
		$mailer->setSender($sender);
		$user =& JFactory::getUser($userid);
		$recipient = $user->email; 
		$mailer->addRecipient($recipient);	
		$mailer->setSubject('Notification from '.$config->getValue( 'config.sitename' ).' :: your post has been replied');
		$body   = '<h2>Some one has commented on your post: '.$title.'</h2>'
				. '<div>You can visit the post in the link: '.$postLink;
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$mailer->setBody($body);
		$send =& $mailer->Send();
	}

}
