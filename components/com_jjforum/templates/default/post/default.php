<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
?>

<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

// no direct access
defined('_JEXEC') or die;
?>
<!--<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
	FB.init({
	  appId: '351360998236172',
	  cookie: true,
	  xfbml: true,
	  oauth: true
	});
	FB.Event.subscribe('auth.login', function(response) {
	  window.location.reload();
	});
	FB.Event.subscribe('auth.logout', function(response) {
	  window.location.reload();
	});
	<?php if($this->user->id == 0 && strstr($this->fbuser,'index')){ ?>
	FB.getLoginStatus(function(response) {
	  if (response.status === 'connected') {
			var uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			window.location="<?php echo $this->fbuser; ?>";
		} 
	 });	
	<?php } ?>
	
  };
  (function() {
	var e = document.createElement('script'); 
	e.async = true;
	e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
	document.getElementById('fb-root').appendChild(e);
  }());
</script>-->
<div id="jjForum_posts_wrapper">
<?php
	if($this->user->id == 0){ ?>
	<div class="jjForum_user0">
	    <?php echo JText::_('Please');?> <a href="#" class="jjForum_login"><?php echo JText::_('login');?></a> / <a href="#" id="jjForum_register"><?php echo JText::_('register');?></a> <?php echo JText::_('in order to reply');?> 
        <!--include the social loggin-->
        <?php //if($this->user->id == 0 && !strstr($this->fbuser,'index')){ ?>
        <?php //echo $this->fbuser; ?>
        <?php //} ?>
    </div>
<?php
	} else { ?>
	<div class="jjForum_user1">
    	<?php if(strstr($this->fbuser,'isuser')){?>
        <img style="float:left; margin:0px 10px 10px 0" width="70" src="https://graph.facebook.com/<?php echo substr($this->fbuser, 7); ?>/picture">
        <?php } else {?>
        <img style="float:left; margin:0px 10px 10px 0" width="70" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim($this->user->email))); ?>.png"  />
        <?php } ?>
	    <?php echo JText::_('Hello');?> <?php echo $this->user->name ?> (<a href="#" class="jjForum_logout"><?php echo JText::_('logout');?></a><?php echo JHtml::_('form.token'); ?>)
        <div class="JJclear"></div>
    </div>
<?php
	}?> 
    
    <div class="JJclear"></div>
	<div id="jjForum_post">    
<?php    
	$post = $this->item[0];
	$tags = explode(',',$post->tags);
	?>
    	<?php if($this->params->get('show_title') != '0'):?>
    	<h3 class="JJToggler">
        	<?php 
			//new icon
		//	echo (strtotime($post->created_date) >= strtotime($this->XdaysAgo)) ? JText::_('NEW!') : '';
			?>
        	<?php if($this->params->get('show_editor') != '0'):?>
        	<a id="<?php echo $post->id;?>-<?php echo $post->catid;?>-<?php echo $this->itemid;?>" name="post<?php echo $post->id;?>" rev="" class="JJtitle JJsingle" href="#"><?php echo $post->title;?></a>
            <?php endif; ?>
            <?php if($this->isAdmin){?>
            <a href="#" id="JJremove-<?php echo $post->id;?>" class="JJremovePost"></a>
            <?php } ?>
        	<div class="JJclear"></div>
        </h3>
        <?php endif;?>
        <div class="JJpostTxt">
        	<div class="JJpostSide">
        	    <?php if($this->params->get('show_editor') != '0'):?>
    	        <span class="JJuserBy">
                    <img class="avatar" width="70" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim($post->email))); ?>.png"  />
                    by: <strong><?php echo $post->uname;?></strong>
                    <img src="components/com_jjforum/templates/default/images/<?php echo getUserRank($post->uid); ?>.png" class="JJrankAvatar" title="post by:<?php echo $post->uname;?>" alt="post by: <?php echo $post->uname;?>" >
                </span>
	            <?php endif;?>
				<?php if($this->params->get('show_votes') != '0'):?>
                <div class="JJvotes" id="vote<?php echo $post->id;?>">
                    <?php if($this->user->id != $post->user_id){?>
                    <a class="JJvotesPlusOne" rel="<?php echo $post->id;?>~<?php echo $post->votes;?>~plus" href="#" title="votes +"></a>
                    <?php } ?>
                    <span class="JJvote"><?php echo (strstr($post->votes, '-') || $post->votes == 0)?$post->votes:$post->votes.'+';?></span>
                    <?php if($this->user->id != $post->user_id){?>
                    <a class="JJvotesMinusOne" rel="<?php echo $post->id;?>~<?php echo $post->votes;?>~minus" href="#" title="votes -"></a>
                    <?php } ?>
                </div>
                <?php endif;?>
            </div>
        	<div class="JJpostMain">
                <p><?php echo $post->text;?></p>
                <?php if($post->tags && $this->params->get('show_tags') != '0'):?>
                <p><?php //echo JText::_('TAGS');?><?php foreach($tags as $tag){?>
                    <a class="JJtag" href="index.php?option=com_jjforum&view=tags&tag=<?php echo $tag;?>&Itemid=<?php echo $this->itemid; ?>"><?php echo $tag;?></a>
                <?php } ?></p>
                <?php endif;?>        
                
            </div>    
            <div class="JJclear"></div>   
            <div class="JJnew_replyWrapper">
            	<?php if($this->params->get('show_simlink') != '0'):?>
                <?php echo JText::_('Share link');?>: <input class="JJsimlink" type="text" readonly="readonly" value="<?php echo $this->current.'#post'.$post->id;?>" />
                <?php endif;?>  
            	<?php if($this->user->id != 0){ ?>
                <a href="#" rel="post" id="<?php echo $post->catid.'-'.$post->id.'-'.$post->level; ?>" class="JJreply"><?php echo JText::_('Add Reply');?></a>
                <a href="#" rel="post2" id="<?php echo $post->catid.'-'.$post->id.'-'.$post->level; ?>" class="JJreply2"><?php echo JText::_('Quote and add Reply');?></a>
                <?php } else { ?>
                <?php echo JText::_('Please');?> <a href="#" class="jjForum_login"><?php echo JText::_('login');?></a> <?php echo JText::_('to reply');?>
                <?php } ?>
            </div>
            <div class="reply_wrapper replies-<?php echo $post->catid.'-'.$post->id.'-'.$post->level; ?>"></div>
        </div> 	
    
		<div id="JJnewPostWrapper"></div>
    </div>
</div>
<?php 
//include the forms
echo ($this->user->id != 0) ? $this->forms : '';
?>
 	
<center>By <a href="http://www.jjextensions.com/" target="_blank">JJExtensions</a>
</center>
