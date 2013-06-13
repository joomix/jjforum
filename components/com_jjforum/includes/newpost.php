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
/*function getVideo($video_id, $video_provider, $width = '450', $height = '300'){
	if($video_id){
		switch($video_provider){
			case 'youtube':
			 return "<iframe src=\"http://www.youtube.com/embed/".$video_id."?wmode=opaque
	\" width=\"".$width."\" height=\"".$height."\" frameborder=\"0\" allowfullscreen title=\"JJForum Video Player\"></iframe>";
			break;
			case 'vimeo':
			 return "<iframe src=\"http://player.vimeo.com/video/".$video_id."?portrait=0\" width=\"".$width."\" height=\"".$height."\" frameborder=\"0\" title=\"JJForum Video Player\"></iframe>";
			break;
			case 'google':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://video.google.com/googleplayer.swf?docid=".$video_id."&hl=en&fs=true\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://video.google.com/googleplayer.swf?docid=".$video_id."&hl=en&fs=true\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"always\" />
					</object>";
			break;
			case '123video':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://www.123video.nl/123video_emb.swf?mediaSrc=".$video_id."\" title=\"JJForum Video Player\">
					<param name=\"movie\" value=\"http://www.123video.nl/123video_emb.swf?mediaSrc=".$video_id."\" />
					<param name=\"quality\" value=\"high\" />
					<param name=\"wmode\" value=\"transparent\" />
					<param name=\"bgcolor\" value=\"#FFF\" />
				</object>";
			break;
			case 'aniboom':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://api.aniboom.com/e/".$video_id."\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://api.aniboom.com/e/".$video_id."\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"allowscriptaccess\" value=\"sameDomain\" />
					</object>";
			break;
			case 'flickr':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://www.flickr.com/apps/video/stewart.swf.v71377\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://www.flickr.com/apps/video/stewart.swf.v71377\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"autoplay\" value=\"false\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"always\" />
						<param name=\"flashvars\" value=\"intl_lang=en-us&amp;div_id=stewart_swf".$video_id."_div&amp;flickr_notracking=true&amp;flickr_target=_self&amp;flickr_h=".$height."&amp;flickr_w=".$width."&amp;flickr_no_logo=true&amp;onsite=true&amp;flickr_noAutoPlay=false&amp;in_photo_gne=true&amp;photo_secret=6e33ea4246&amp;photo_id=".$video_id."&amp;flickr_doSmall=true\" />
					</object>";
			break;
			case 'metacafe':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://www.metacafe.com/fplayer/".$video_id.".swf\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://www.metacafe.com/fplayer/".$video_id.".swf\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"autoplay\" value=\"false\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"always\" />
					</object>";
			break;
			case 'myspace':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://mediaservices.myspace.com/services/media/embed.aspx/m=".$video_id.",t=1,mt=video\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://mediaservices.myspace.com/services/media/embed.aspx/m=".$video_id.",t=1,mt=video\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"autoplay\" value=\"false\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"sameDomain\" />
					</object>";
			break;
			case 'myvideo':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://www.myvideo.de/movie/".$video_id."\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://www.myvideo.de/movie/".$video_id."\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"autoplay\" value=\"false\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"always\" />
					</object>";
			break;
			case 'screenr':
			 return "<iframe src=\"http://www.screenr.com/embed/".$video_id."\" frameborder=\"0\" width=\"".$width."\" height=\"".$height."\" title=\"JJForum Video Player\"></iframe>";
			break;
			case 'sohu':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://share.vrs.sohu.com/my/v.swf&id=".$video_id."&skinNum=2&topBar=1\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://share.vrs.sohu.com/my/v.swf&id=".$video_id."&skinNum=2&topBar=1\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"autoplay\" value=\"false\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"Always\" />
					</object>";
			break;
			case 'yahoo':
			 return "<object type=\"application/x-shockwave-flash\" style=\"width:".$width."px;height:".$height."px;\" data=\"http://d.yimg.com/nl/vyc/site/player.swf\" title=\"JJForum Video Player\">
						<param name=\"movie\" value=\"http://d.yimg.com/nl/vyc/site/player.swf\" />
						<param name=\"quality\" value=\"high\" />
						<param name=\"wmode\" value=\"transparent\" />
						<param name=\"bgcolor\" value=\"#FFF\" />
						<param name=\"autoplay\" value=\"false\" />
						<param name=\"allowfullscreen\" value=\"true\" />
						<param name=\"allowscriptaccess\" value=\"always\" />
						<param name=\"flashvars\" value=\"vid=".$video_id."&amp;autoPlay=false&amp;volume=100&amp;enableFullScreen=1\" />
					</object>";
			break;
		}	
	}
}*/
$userID = $user->get('id');
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
	$sumRank = $countPosts->count * $countPosts->votes;
	switch ($sumRank){
		default:
			$rank = 'white';
			break;
		case ($sumRank >= 5 && $sumRank <= 200):
			$rank = 'green';
			break;
		case ($sumRank >= 201 && $sumRank <= 1000):
			$rank = 'senior';
			break;
		case ($sumRank >= 1001):
			$rank = 'king';
			break;
	}
	return $rank;
}

$app		= JFactory::getApplication();
$params		=& $app->getParams('com_jjforum');

$postid = JRequest::getVar('postid');
$current = JRequest::getVar('curruri');
$itemid = JRequest::getVar('Itemid');
$username = JRequest::getVar('username');

$db = JFactory::getDBO();
$query	= $db->getQuery(true);
$query->select(
	'a.*, b.name as uname'
	);
$query->from("#__jjforum_post as a,#__users as b");
$query->where("a.id = $postid AND a.user_id = b.id ");

$db->setQuery((string)$query);
if (!$db->query()) {
	echo $db->getErrorMsg();
}
$u =& JURI::getInstance();
$baseuri = $u->toString( array( 'scheme', 'host' ) );

$post = $db->loadObject();
$tags = explode(',',$post->tags);
?>
<h3 class="JJToggler">
    <a name="post<?php echo $post->id;?>" class="JJtitle open loaded" href="#"><?php echo $post->title;?></a>
    <a class="JJdirectLink" title="<?php echo JText::_('Direct link');?>" href="<?php echo 'index.php?option=com_jjforum&view=post&id='.$post->id.'&Itemid='.$itemid;?>" target="_blank">&nbsp;</a>    
    <div class="JJclear"></div>
</h3>
<div class="JJpostTxt" style="display:block">
	<div class="JJpostSide">
		<?php if($params->get('show_editor') != '0'):?>
        <span class="JJuserBy">
            <img class="avatar" width="70" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim($post->email))); ?>.png">
            by: <strong><?php echo $post->uname;?></strong>
            <img src="components/com_jjforum/templates/default/images/<?php echo getUserRank($userID);?>.png" class="JJrankAvatar" title="post by:<?php echo $post->uname;?>" alt="post by: <?php echo $post->uname;?>">
        </span>        
        <?php endif;?>
    </div>
    <div class="JJpostMain">
        <p><?php echo $post->text;?></p>
        <?php if($post->tags && $params->get('show_tags') != '0'):?>
        <p>
		   <?php foreach($tags as $tag){?>
            <a class="JJtag" href="<?php echo JRoute::_('index.php?option=com_jjforum&view=tags&tag='.$tag.'&Itemid='.$itemid)?>"><?php echo $tag;?></a>
           <?php } ?>
        </p>
        <?php endif;?>        
    </div>    
    <div class="JJclear"></div>   
    <div class="JJnew_replyWrapper">
        <?php if($params->get('show_simlink') != '0'):?>
        <?php echo JText::_('Share link');?>: <input class="JJsimlink" type="text" readonly="readonly" value="<?php echo base64_decode($current).'#post'.$post->id;?>" />
        <?php endif;?> 
    </div>
	
</div> 	
