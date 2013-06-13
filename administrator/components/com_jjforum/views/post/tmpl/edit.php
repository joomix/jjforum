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
		if (task == 'post.cancel' || document.formvalidator.isValid(document.id('post-form'))) {
			Joomla.submitform(task, document.getElementById('post-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jjforum&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="post-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_JJFORUM_LEGEND_POST'); ?></legend>
			<ul class="adminformlist">

            
			<li><?php echo $this->form->getLabel('id'); ?>
			<?php echo $this->form->getInput('id'); ?></li>

            
			<li><?php echo $this->form->getLabel('user_id'); ?>
			<?php echo $this->form->getInput('user_id'); ?></li>

            
			<li><?php echo $this->form->getLabel('title'); ?>
			<?php echo $this->form->getInput('title'); ?></li>

            
			<li><?php echo $this->form->getLabel('text'); ?>
			<?php echo $this->form->getInput('text'); ?></li>

            
			<li><?php echo $this->form->getLabel('tags'); ?>
			<?php echo $this->form->getInput('tags'); ?></li>

            
			<li><?php echo $this->form->getLabel('image'); ?>
			<?php echo $this->form->getInput('image'); ?></li>

            
			<li><?php echo $this->form->getLabel('votes'); ?>
			<?php echo $this->form->getInput('votes'); ?></li>

            
			<li><?php echo $this->form->getLabel('created_date'); ?>
			<?php echo $this->form->getInput('created_date'); ?></li>

            
			<li><?php echo $this->form->getLabel('video_id'); ?>
			<?php echo $this->form->getInput('video_id'); ?></li>

            
			<li><?php echo $this->form->getLabel('video_provider'); ?>
			<?php echo $this->form->getInput('video_provider'); ?></li>

            

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