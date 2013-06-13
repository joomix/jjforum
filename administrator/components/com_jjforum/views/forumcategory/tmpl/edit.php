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

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'forumcategory.cancel' || document.formvalidator.isValid(document.id('forumcategory-form'))) {
			Joomla.submitform(task, document.getElementById('forumcategory-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jjforum&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="forumcategory-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_JJFORUM_LEGEND_FORUMCATEGORY'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>
			<li style="clear:both;"></li>
            
			<li><?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?></li>
			<li style="clear:both;"></li>
            
			<li><?php echo $this->form->getLabel('description'); ?>
			<?php echo $this->form->getInput('description'); ?></li>
			<li style="clear:both;"></li>
            
			<li><?php echo $this->form->getLabel('image'); ?>
			<?php echo $this->form->getInput('image'); ?>
            <div class="button2-left"><div class="image"><a rel="{handler: 'iframe', size: {x: 800, y: 500}}" onclick="IeCursorFix(); return false;" href="http://jjforum.goomla.co.il/administrator/index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=jform_image&amp;asset=&amp;author=" title="Image" class="modal-button">Image</a></div></div>
			<img src="/<?php echo $this->form->getValue('image'); ?>" />
 
            </li>
			<li style="clear:both;"></li>
                        
            <li><?php echo $this->form->getLabel('state'); ?>
                    <?php echo $this->form->getInput('state'); ?></li><li><?php echo $this->form->getLabel('checked_out'); ?>
                    <?php echo $this->form->getInput('checked_out'); ?></li><li><?php echo $this->form->getLabel('checked_out_time'); ?>
                    <?php echo $this->form->getInput('checked_out_time'); ?></li>

            </ul>
		</fieldset>
	</div>


	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
	<div class="clr"></div>
</form>