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
class JjforumViewPosts extends JView
{
	protected $state;
	protected $item;
	protected $pagination;
	
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

	function display($tpl = null)
	{
		$app		= JFactory::getApplication();
		$this->params		= $app->getParams();
		$catid   = JRequest::getVar('id'); 
		$uri     = & JURI::getInstance();
		$current = $uri->toString( array('scheme', 'host', 'port', 'path', 'query'));
		$user	 = JFactory::getUser();
		$userId	 = $user->get('id');
		$catid   = JRequest::getVar('id'); 
		$order   = JRequest::getVar('order'); 
		$uri     = & JURI::getInstance();
		$current = $uri->toString( array('scheme', 'host', 'port', 'path', 'query'));
		$itemid = JRequest::getVar('Itemid');

		// Get some data from the models
		$state		= $this->get('State');
		$this->item		= $this->get('Item');
		$this->cat		= $this->get('Category');
		$this->fbuser   = $this->get('Fbconnect');

	//	if ($this->params->get('theme')) {
		$this->_addPath('template', JPATH_COMPONENT.DS.'templates'.DS.$this->params->get('theme').DS.'posts');
	//	}

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
		
		$forms = '
		<div id="JJreplyFormWrapper" style="width: 400px; display:none;">
			<form id="JJnewReplyForm" action="" method="post">
				<div class="jjFormRow">
					<label for="JJtopic">Title:</label>
					<input type="text" name="jjForum[JJtopic]" id="JJtopic" />
				</div>
				<div class="jjFormRow">
					<label for="JJpost">Post your message:</label>
					<textarea name="jjForum[JJpost]" cols="50" rows="15" id="JJreplytxt" class="JJreplytxt htmlarea"></textarea>
				</div>';
				 if($this->params->get('include_tags') != '0'):
				$forms .= ' 
				<div class="jjFormRow">
					<label for="JJtags">Tags:</label>
					<input type="text" name="jjForum[JJtags]" id="JJtags" class="JJtags" />
				</div>';
				 endif;
				 $forms .= '
				<div class="jjFormRow">
					<input type="button" id="jjForumSubmitReply" value="Post" />
					or
					<a href="#" class="JJcancelForm">Cancel</a>
				</div>
				<input type="hidden" name="jjForum[JJparams]" id="JJparams" value="" />                        
				<input type="hidden" name="jjForum[JJrel]" id="JJrel" value="" />                        
			</form>
		</div>
		<div id="JJpostFormWrapper" style="display:none; width: 400px;">
			<form id="JJnewPostForm" action="" method="post">
				<div class="jjFormRow">
					<label for="JJtopic">Title:</label>
					<input type="text" name="jjForum[JJtopic]" id="JJtopic" />
				</div>
				<div class="jjFormRow">
					<label for="JJpost">Post your message:</label>
					<textarea name="jjForum[JJpost]" cols="50" rows="15" id="JJpost" class="JJpost htmlarea"></textarea>
				</div>';
				if($this->params->get('include_tags') != '0'):
				$forms .= '
				<div class="jjFormRow">
					<label for="JJtags">Tags:</label>
					<input type="text" name="jjForum[JJtags]" id="JJtags" class="JJtags" />
				</div>';
				 endif;
//				if($this->params->get('include_image') != '0'):
//				$forms .= '
//				<div class="jjFormRow">
//					<label for="JJimage" style="float:left; margin-right:6px;">Include Image:</label>
//					<input type="file" class="JJimage" name="JJimage" id="JJimage" />
//					<input type="hidden" class="JJfile" name="JJfile" id="JJfile" />
//				</div>';
//				endif;
//				if($this->params->get('include_video') != '0'):
//				$forms .= '
//				<div class="jjFormRow">
//					<label for="JJvideo_id">Include video:</label>
//					<select name="jjForum[JJvideo_provider]" id="JJvideo_provider">
//						<option value="youtube">Youtube</option>
//						<option value="vimeo">Vimeo</option>
//						<option value="google">Google</option>
//						<option value="123video">123video</option>
//						<option value="aniboom">Aniboom</option>
//						<option value="flickr">Flickr</option>
//						<option value="metacafe">Metacafe</option>
//						<option value="myspace">Myspace</option>
//						<option value="myvideo">Myvideo</option>
//						<option value="screenr">Screenr</option>
//						<option value="sohu">Sohu</option>
//						<option value="yahoo">Yahoo</option>
//					</select>
//					<input type="text" name="jjForum[JJvideo_id]" id="JJvideo_id" value="Video ID" onblur="if (this.value==\'\') this.value=\'Video ID\';" onfocus="if (this.value==\'Video ID\') this.value=\'\';" />
//				</div>';
//				endif;
				if($this->params->get('allow_notify') != '0'):
				$forms .= '
				<div class="jjFormRow">
					<label for="JJnotify">
					<input type="checkbox" name="jjForum[JJnotify]" value="1" id="JJnotify" />
					Notify me on replys to my post
					</label>
				</div>';
				endif;
				$forms .= '
				<div class="jjFormRow">
					<input type="button" id="jjForumSubmitPost" value="Post" />
					or
					<a href="#" class="JJcancelForm">Cancel</a>
				</div>
				<input type="hidden" name="jjForum[JJcatid]" id="JJcatid" value="'. $catid .'" />
				<input type="hidden" name="jjForum[JJcurruri]" id="JJcurruri" value="'. base64_encode($current) .'" />
					</form>
				</div>
				';

		$date = date('Y-m-j G:i:s');
		$XdaysAgo = date('Y-m-j G:i:s', strtotime('-'.$this->params->get('mark_as_new', 3).' day'.$date)); 
		
		$user	= JFactory::getUser();
		if($user->authorise('core.admin','com_jjforum'))
		$isAdmin = 1;
		else
		$isAdmin = 0;
				
		// Assign data
		$this->assignRef('forms', $forms);
		$this->assignRef('XdaysAgo', $XdaysAgo);
		$this->assignRef('user', $user);
		$this->assignRef('isAdmin', $isAdmin);
		$this->assignRef('catid', $catid);
		$this->assignRef('uri', $uri);
		$this->assignRef('current', $current);
		$this->assignRef('itemid', $itemid);
		$this->assignRef('order', $order);
//		$this->assignRef('facebookLogin', $FBlogin);
//		$this->assignRef('FBuser', $FBuser);
//		$this->assignRef('FBlogin', $FBlogin);
//		$this->assignRef('FBloginUrl', $FBloginUrl);
//		$this->assignRef('FBprofile', $FBprofile);
		
        parent::display($tpl);

	} 
		
}