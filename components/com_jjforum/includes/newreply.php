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
$app		= JFactory::getApplication();
$params		=& $app->getParams('com_jjforum');
$user = JFactory::getUser();
$postid = JRequest::getVar('postid');
$current = JRequest::getVar('curruri');
$itemid = JRequest::getVar('Itemid');

$db = JFactory::getDBO();
$query	= $db->getQuery(true);
$query->select(
	'a.*'
	);
$query->from("#__jjforum_post as a");
$query->where("a.id = $postid");

$db->setQuery((string)$query);
if (!$db->query()) {
	echo $db->getErrorMsg();
}

$post = $db->loadObject();
$tags = explode(',',$post->tags);
?>
<li>
    <div class="JJthreadTxt level-<?php echo $post->level; ?>">
        <h4><?php echo $post->title;?></h4>
        <div class="JJthreadTxts">
            <span class="JJuserBy" style="text-align:left;">
                <img class="avatar" width="40" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim($user->email))); ?>.png"  />
                <span>by: <strong><?php echo $user->name;?></strong></span>
                <img class="user_rank_reply" alt="<?php echo $user->name;?>" title="<?php echo $user->name;?>" src="<?php echo JURI::base(true)?>components/com_jjforum/templates/default/images/<?php echo getUserRank($user->id); ?>.png" /> 
            </span> 
            <?php echo $post->text;?>
            <?php if($post->tags):?>
            <div class="JJthreadTags">
                <?php foreach($tags as $tag){?>
                <a class="JJtag" href="<?php echo JRoute::_( $base.'index.php?option=com_jjforum&view=tags&tag='.$tag.'&Itemid='.$itemid); ?>"><?php echo $tag;?></a>
                <?php } ?>
            </div>
            <?php endif;?>  
        </div>
    </div> 
</li>