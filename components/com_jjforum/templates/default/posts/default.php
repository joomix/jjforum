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
	<div class="jjForum_cat">
    	<?php if($this->params->get('show_category_image') != '0'):?>
    	<?php if($this->cat->image){?>
    	<a href="index.php?option=com_jjforum&view=posts&id=<?php echo $this->cat->id;?>&Itemid=<?php echo $this->itemid;?>"><img class="jjForum_cat_img" src="<?php echo $this->cat->image;?>"  /></a>
		<?php } else { ?>
    	<a href="index.php?option=com_jjforum&view=posts&id=<?php echo $this->cat->id;?>&Itemid=<?php echo $this->itemid;?>"><img class="jjForum_cat_img" src="<?php echo JURI::base(true) . "/components/com_jjforum/templates/default/images/folder.png"; ?>"  /></a>
		<?php } ?>
        <?php endif;?>
    	<?php if($this->params->get('show_feed') != '0'):?>
    	<a class="JJRSS" target="_blank" title="Subscribe to this category feeds" href="index.php?option=com_jjforum&view=categories&id=<?php echo $this->cat->id;?>&format=feed&type=rss&Itemid=<?php echo $this->itemid;?>"></a>
        <?php endif;?>
    	<?php if($this->params->get('show_category_title') != '0'):?>
    	<h3><a href="index.php?option=com_jjforum&view=posts&id=<?php echo $this->cat->id;?>&Itemid=<?php echo $this->itemid;?>"><?php echo $this->cat->title;?></a>
        </h3>
        <?php endif;?>
    	<?php if($this->params->get('show_category_description') != '0'):?>
    	<p><?php echo $this->cat->description;?></p>
        <?php endif;?>
        <br style="clear:both" />
    </div> 	
<?php
	if($this->user->id == 0){ ?>
	<div class="jjForum_user0">
	    <?php echo JText::_('Please');?> <a href="#" class="jjForum_login"><?php echo JText::_('login');?></a> / <a href="index.php?option=com_users&view=registration" id="jjForum_register"><?php echo JText::_('register');?></a> <?php echo JText::_('in order to post');?> 
        <!--include the social loggin-->
        <?php //if($this->user->id == 0 && !strstr($this->fbuser,'index')){ ?>
        <?php //echo $this->fbuser; ?>
        <?php // } ?>
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
        <div class="JJnew_post">
        	<a href="#" id="JJnew_post"><?php echo JText::_('Add new post');?></a>
        </div>
    </div>
<?php
	}?> 
    <div id="JJordering">
        <label for="ordering"><?php echo JText::_('ordering');?></label>
        <select onchange="location.href=this.options[this.selectedIndex].value;" id="ordering" name="orderPosts">
            <option <?php echo ($this->order == 'default')?'selected="selected"':'';?> value="<?php echo JRoute::_('index.php?option=com_jjforum&view=posts&id='.$this->catid.'&Itemid='.$this->itemid.'&limitstart=0&order=default')?>"><?php echo JText::_('default');?></option>
            <option <?php echo ($this->order == 'newest')?'selected="selected"':'';?> value="<?php echo JRoute::_('index.php?option=com_jjforum&view=posts&id='.$this->catid.'&Itemid='.$this->itemid.'&limitstart=0&order=newest')?>"><?php echo JText::_('Newest first');?></option>
            <option <?php echo ($this->order == 'oldest')?'selected="selected"':'';?> value="<?php echo JRoute::_('index.php?option=com_jjforum&view=posts&id='.$this->catid.'&Itemid='.$this->itemid.'&limitstart=0&order=oldest')?>"><?php echo JText::_('Oldest first');?></option>
            <option <?php echo ($this->order == 'rating')?'selected="selected"':'';?> value="<?php echo JRoute::_('index.php?option=com_jjforum&view=posts&id='.$this->catid.'&Itemid='.$this->itemid.'&limitstart=0&order=rating')?>"><?php echo JText::_('By rating');?></option>
        </select>
    </div>
    <div class="JJclear"></div>
	<div id="jjForum_post">    
<?php    
foreach($this->item->data as $post){
	$tags = explode(',',$post->tags);
	?>
    	<?php if($this->params->get('show_title') != '0'):?>
    	<h3 class="JJToggler">
        	<?php 
			//new icon
			echo (strtotime($post->created_date) >= strtotime($this->XdaysAgo)) ? JText::_('NEW!') : '';
			?>
        	<?php if($this->params->get('show_editor') != '0'):?>
        	<a id="<?php echo $post->id;?>-<?php echo $this->catid;?>-<?php echo $this->itemid;?>" name="post<?php echo $post->id;?>" rev="" class="JJtitle" href="#"><?php echo $post->title;?></a>
            <?php endif; ?>
        	<?php if($this->params->get('show_create_date') != '0'):?>
            <span class="JJcreatedDate"><?php echo JHtml::_('date',$post->created_date, JText::_($this->params->get('date_format')));?></span>
            <?php endif; ?>
        	<?php if($this->params->get('show_intro_tip') != '0'):
					if(strlen($post->text)>50){
						if(function_exists("mb_substr")) {
							$text = mb_substr($post->text, 0, 50);
						} else {
							$text = substr($post->text, 0, 50);
						}
						echo '<span class="JJIntro">'.strip_tags(rtrim($text)).'...</span>';
					} else {
						echo '<span class="JJIntro">'.strip_tags($post->text).'</span>';
					}
				  endif; ?>
            <?php if($this->isAdmin){?>
            <a href="#" id="JJremove-<?php echo $post->id;?><?php if($post->image){ echo '-'.base64_encode($post->image);} ?>" class="JJremovePost"></a>
            <?php } ?>
            <a class="JJdirectLink" title="<?php echo JText::_('Direct link');?>" href="<?php echo 'index.php?option=com_jjforum&view=post&id='.$post->id.'&Itemid='.$this->itemid;?>" target="_blank">&nbsp;</a>
        	<div class="JJclear"></div>
        </h3>
        <?php endif;?>
        <div class="JJpostTxt" style="display:none">
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
                <a href="#" rel="post" id="<?php echo $this->catid.'-'.$post->id.'-'.$post->level; ?>" class="JJreply"><?php echo JText::_('Add Reply');?></a>
                <?php if($post->text){?>
                <a href="#" rel="post2" id="<?php echo $this->catid.'-'.$post->id.'-'.$post->level; ?>" class="JJreply2"><?php echo JText::_('Quote and add Reply');?></a>
                <?php } ?>
                <?php } else { ?>
                <?php echo JText::_('Please');?> <a href="#" class="jjForum_login"><?php echo JText::_('login');?></a> <?php echo JText::_('to reply');?>
                <?php } ?>
            </div>
            <div class="reply_wrapper replies-<?php echo $this->catid.'-'.$post->id.'-'.$post->level; ?>"></div>
        </div> 	
    
<?php } ?>
		<div id="JJnewPostWrapper"></div>
    </div>
</div> 	
<?php 
//include the forms
echo ($this->user->id != 0) ? $this->forms : '';
?>
<div class="JJpagination">
	<?php echo $this->item->paging; ?>
</div>
<center>By <a href="http://www.jjextensions.com/" target="_blank">JJExtensions</a>
</center>