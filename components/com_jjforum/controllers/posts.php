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
jimport('joomla.filesystem.file');

class JjforumControllerPosts extends JController
{
	function newpost(){
		$app =& JFactory::getApplication(); 
		$post    = JRequest::getVar('jjForum', array(), 'post', 'array'); 
		$itemid = JRequest::getVar('Itemid');
		$user	 = JFactory::getUser();
		$userId	 = $user->get('id');
		$userName	 = $user->get('username');

		if ($post) {
			//get the posted data
			$post['JJfile'] = ($post['JJfile'] == 'undefined')?'':$post['JJfile'];		
			$db = JFactory::getDBO();
			$data =new JObject();
			
			$data->ordering =                     0;
			$data->state =                        1;
			$data->checked_out =                  0;
			$data->checked_out_time =             '0000-00-00 00:00:00';
			$data->catid =                        $post['JJcatid'];
			$data->title =                        $post['JJtopic'];
			$data->text =                         $post['JJpost'];
			$data->tags =                         $post['JJtags'];
			$data->user_id =                      $userId;
			$data->image =                        $post['JJfile'];
			$data->created_date =                 date('Y-m-d H:i:s');
			$data->video_id =                     ($post['JJvideo_id'] == 'Video ID') ? '' : $post['JJvideo_id'];
			$data->video_provider =               $post['JJvideo_provider'];
			$data->level =                        0;
			$data->notify =                       $post['JJnotify'];
			//get the next ID from the table
			$query = 'SELECT MAX(id) FROM #__jjforum_post';
			$db->setQuery($query);
			//get the newly created id
			$nextId = $db->loadResult() + 1;
			//get the previous id
			$data->pid = $nextId - 1;
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
			
			$this->setRedirect(JRoute::_('components/com_jjforum/includes/newpost.php?postid='.$postId.'&curruri='.$post['JJcurruri'].'&Itemid='.$itemid.'&username='.$userName, false));
		} 
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
		//	$this->notifyUser($data->level,$data->pid,$data->user_id,$data->notify,$data->title,$postId);
			$this->getParent($data->pid);
			$this->setRedirect(JRoute::_('components/com_jjforum/includes/newreply.php?postid='.$postId, false));
		} 
	}

	function removepost(){
			$postid    = JRequest::getVar('postid'); 
			$user	 = JFactory::getUser();
			$postid = explode('-', $postid);
			if ($postid && $user->authorise('core.admin','com_jjforum')) {
				$db = JFactory::getDBO();				
				$ret = $db->setQuery('DELETE FROM #__jjforum_post WHERE id = '.$postid[1]);
				$db->query();
				if (!$ret) {
					echo $db->getErrorMsg();
					return false;
				}
				//remove the image from the server
				if(isset($postid[2]) && strlen($postid[2]) > 3){
					$image = JPATH_SITE . DS . "images" . DS. "jjforum" . DS . base64_decode($postid[2]);
					JFile::delete($image);
					$thumb = JPATH_SITE . DS . "images" . DS. "jjforum" . DS . 'thumb_'.base64_decode($postid[2]);
					JFile::delete($thumb);
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
				$this->emailUser($userid,$title,$postid);
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
		$postLink = JRoute::_('index.php?option=com_jjforum&view=post&id='.$postid);
		$mailer->setSender($sender);
		$user =& JFactory::getUser($userid);
		$recipient = $user->email; 
		$mailer->addRecipient($recipient);	
		$mailer->setSubject('Notification from '.$config->getValue( 'config.sitename' ).' :: your post has been replied');
		$body   = '<h2>Some one has commented on your post: '.$title.'</h2>'
				. '<div>You can visit the post in the link: '.JURI::base().substr($postLink, 1).'</div>';
		$mailer->isHTML(true);
		$mailer->Encoding = 'base64';
		$mailer->setBody($body);
		$send =& $mailer->Send();
	}

}