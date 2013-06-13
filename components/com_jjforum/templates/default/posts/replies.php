<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */
// a single thread HTML
?>
<div class="JJthreadTxt level-<?php echo $post->level;?> reply-<?php echo $catid.'-'.$post->id.'-'.$post->level; ?>">
    <h4><?php echo $post->title;?> 
		<?php if($user->id != 0){ ?>
        <span class="JJthreadIcons">
            <?php if($isAdmin){?>
            <a href="#" id="JJremove-<?php echo $post->id;?>" class="JJremoveThread"></a>
            <?php } ?>
            <a id="<?php echo $catid.'-'.$post->id.'-'.$post->level; ?>" rel="thread" href="#" class="JJnew_reply JJreplyIcon" title="Add Reply"></a>
            <?php if($post->text){?>
            <a id="<?php echo $catid.'-'.$post->id.'-'.$post->level; ?>" rel="thread2" href="#" class="JJnew_reply JJquoteIcon" title="Quote and add Reply"></a>
            <?php } ?>
        </span>
        <?php } else { ?>
        <span class="JJthreadIcons">
            please <a href="#" class="jjForum_login">loggin</a> to reply
        </span>
        <?php } ?>   
    </h4>
    <?php //if($post->text){?>
    <div class="JJthreadTxts">
        <span class="JJuserBy">
            <?php //check if the user came from FB
                if(strstr($user->name, 'FB_')){?>
                <img class="avatar" width="40" src="https://graph.facebook.com/<?php echo substr($user->name, 3); ?>/picture">
            <?php } else { //try gravatar img ?>
                <img class="avatar" width="40" src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim($user->email))); ?>.png"  />
            <?php } ?>
            <span>by: <strong><?php echo $user->name;?></strong></span>
            <img class="user_rank_reply" alt="<?php echo $user->name;?>" title="<?php echo $user->name;?>" src="<?php echo $base; ?>components/com_jjforum/templates/default/images/<?php echo getUserRank($post->uid); ?>.png" /> 
        </span> 
    	<?php echo $post->text;?>
		<?php if($post->tags):?>
        <div class="JJthreadTags">
            <?php foreach($tags as $tag){?>
            <a class="JJtag" href="<?php echo JRoute::_( $base.'index.php?option=com_jjforum&view=tags&tag='.$tag.'&Itemid='.$itemid); ?>"><?php echo $tag;?></a>
            <?php } ?>
        </div>
        <?php endif;?>  
        <small><?php echo JHtml::_('date',$post->created_date, JText::_('DATE_FORMAT_LC3'));?></small>      
    </div>
    <?php //} ?>
</div> 