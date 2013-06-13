<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */
// no direct access
define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../../..' ));
define( 'DS', DIRECTORY_SEPARATOR );
include_once ( JPATH_BASE .DS.'components'.DS.'com_jjforum'.DS.'includes'.DS.'lib'.DS.'main_frame.php' );
$params     = JRequest::getVar('params');
$param      = explode('-',$params);
$pid        = $param[0];
$catid      = $param[1];
$itemid     = $param[2];

function getUserRank($userId){
			$db = JFactory::getDBO();
			$query	= $db->getQuery(true);
			$query->select(
				'COUNT(*) as count, sum(votes) as votes'
				);
			$query->from("#__jjforum_post");
			$query->where("state = 1 AND user_id = $userId");
			$db->setQuery((string)$query);
			$countPosts = $db->loadObject(); 
			if (!$db->query()) {
				echo $db->getErrorMsg();
			//	return;
			}
			$sumRank = $countPosts->count + $countPosts->votes;
			switch ($sumRank){
				default:
					$rank = 'white';
					break;
				case ($sumRank >= 5 && $sumRank <= 20):
					$rank = 'green';
					break;
				case ($sumRank >= 21 && $sumRank <= 100):
					$rank = 'senior';
					break;
				case ($sumRank >= 101):
					$rank = 'king';
					break;
			}
			return $rank;
		}

function display_children($parent, $level, $catid) { 
	// retrieve all children of $parent 
	$params     = JRequest::getVar('params');
	$param      = explode('-',$params);
	$pid        = $param[0];
	$catid      = $param[1];
	$itemid     = $param[2];
	$user	 = JFactory::getUser();
	$userId	 = $user->get('id');
	if($user->authorise('core.admin','com_mycomponent'))
	$isAdmin = 1;
	else
	$isAdmin = 0;
	$uri     = & JURI::getInstance();
	$base = $uri->toString( array('scheme', 'host', 'port', 'path'));
	$base = str_replace('components/com_jjforum/includes/replies.php','',$base);
	
	$db = JFactory::getDBO();
	$query	= $db->getQuery(true);
	$query->select('a.*, b.id as uid');
	$query->from("#__jjforum_post as a,#__users as b");
	$query->where('a.catid = '.$catid.' AND a.pid = '.$parent.' AND a.state = 1 AND a.user_id = b.id AND a.level = '.$level.' ORDER BY a.id ASC,a.pid ASC,a.level ASC');
	
	$db->setQuery((string)$query);
	if (!$db->query()) {
		echo $db->getErrorMsg();
	}
	
	$items = $db->loadObjectList();
	if($items){
		$counter = count($items);
		// display each child 
		echo '<ul>';
		foreach($items as $key=>$post){
			$tags = explode(',',$post->tags);
			echo ($counter == $key + 1)?'<li class="JJlast">':'<li>';
			include(JPATH_BASE .DS.'components'.DS.'com_jjforum'.DS.'templates'.DS.'default'.DS.'posts'.DS.'replies.php');
			display_children($post->id, $post->level+1, $post->catid);
		//	echo '<ul>';
			echo '</li>';
			if($counter == $key + 1)
			echo '';
		} 
		echo '</ul>';
	}
} 
display_children($pid, 1,$catid);
?>
