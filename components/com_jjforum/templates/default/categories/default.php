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
$itemid = JRequest::getVar('Itemid');

?>
<div id="jjForum_wrapper">
	<div class="jjForum_tags_wrapper">
    	<h2>Top Tags</h2>
	<?php
    foreach($this->tags as $tag){?>
    	<a class="JJtag" href="index.php?option=com_jjforum&view=tags&tag=<?php echo $tag->name;?>&Itemid=<?php echo $itemid;?>"><?php echo $tag->name;?></a> 
	<?php } ?>
    </div>
    <h2 class="category_title">Forum Categories</h2>
<?php
foreach($this->item as $category){
	$counter = 0;
	foreach($this->count as $count){ 
		if($count->catid === $category->id)
		$counter = $count->count;
	}
	if($this->params->get('show_empty_categories') == '0' && $counter == 0){
		return;
	} else {
	?>
	<div class="jjForum_cat">
    	<?php if($this->params->get('show_category_image') != '0'):?>
    	<?php if($category->image){?>
    	<a href="index.php?option=com_jjforum&view=posts&id=<?php echo $category->id;?>&Itemid=<?php echo $itemid;?>"><img class="jjForum_cat_img" src="<?php echo $category->image;?>"  /></a>
		<?php } else { ?>
    	<a href="index.php?option=com_jjforum&view=posts&id=<?php echo $category->id;?>&Itemid=<?php echo $itemid;?>"><img class="jjForum_cat_img" src="<?php echo JURI::base(true) . "/components/com_jjforum/templates/default/images/folder.png"; ?>"  /></a>
		<?php } ?>
        <?php endif;?>
    	<?php if($this->params->get('show_feed') != '0'):?>
    	<a class="JJRSS" target="_blank" title="Subscribe to this category feeds" href="index.php?option=com_jjforum&view=categories&id=<?php echo $category->id;?>&format=feed&type=rss&Itemid=<?php echo $itemid;?>"></a>
        <?php endif;?>
    	<?php if($this->params->get('show_category_title') != '0'):?>
    	<h3><a href="index.php?option=com_jjforum&view=posts&id=<?php echo $category->id;?>&Itemid=<?php echo $itemid;?>"><?php echo $category->title;?></a>
        <?php if($this->params->get('show_cat_num_posts') != '0'):?>
        
        <span class="counter">
        <?php echo $counter ?>
        </span>
        
        
		<?php endif;?>
        </h3>
        <?php endif;?>
    	<?php if($this->params->get('show_category_description') != '0'):?>
    	<p class="category_description"><?php echo $category->description;?></p>
        <?php endif;?>
        <br style="clear:both" />
    </div> 	
    <?php 
	}
	?>
<?php 
} ?>
</div>
    <center>By JJExtensions</center>
