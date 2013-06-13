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

if($user->id == 0){
?>
<!--<form onsubmit="registerAjax(this); return false;">-->
<form class="form-validate" method="post" action="http://localhost/jjforum/index.php?option=com_jjforum&view=user&task=user.register" id="member-registration">
  <fieldset>
    <legend>User Registration</legend>
    <dl>
      <dt>
        <label title="" class="hasTip required" for="jform_name" id="jform_name-lbl">Name:<span class="star">&nbsp;*</span></label>
      </dt>
      <dd>
        <input type="text" size="30" class="required" value="" id="jform_name" name="jform[name]" aria-required="true" required="required">
      </dd>
      <dt>
        <label title="" class="hasTip required" for="jform_username" id="jform_username-lbl">Username:<span class="star">&nbsp;*</span></label>
      </dt>
      <dd>
        <input type="text" size="30" class="validate-username required" value="" id="jform_username" name="jform[username]" aria-required="true" required="required">
      </dd>
      <dt>
        <label title="" class="hasTip required" for="jform_password1" id="jform_password1-lbl">Password:<span class="star">&nbsp;*</span></label>
      </dt>
      <dd>
        <input type="password" size="30" class="validate-password required" autocomplete="off" value="" id="jform_password1" name="jform[password1]" aria-required="true" required="required">
      </dd>
      <dt>
        <label title="" class="hasTip required" for="jform_password2" id="jform_password2-lbl">Confirm Password:<span class="star">&nbsp;*</span></label>
      </dt>
      <dd>
        <input type="password" size="30" class="validate-password required" autocomplete="off" value="" id="jform_password2" name="jform[password2]" aria-required="true" required="required">
      </dd>
      <dt>
        <label title="" class="hasTip required" for="jform_email1" id="jform_email1-lbl">Email Address:<span class="star">&nbsp;*</span></label>
      </dt>
      <dd>
        <input type="email" size="30" value="" id="jform_email1" class="validate-email required" name="jform[email1]" aria-required="true" required="required">
      </dd>
      <dt>
        <label title="" class="hasTip required" for="jform_email2" id="jform_email2-lbl">Confirm email Address:<span class="star">&nbsp;*</span></label>
      </dt>
      <dd>
        <input type="email" size="30" value="" id="jform_email2" class="validate-email required" name="jform[email2]" aria-required="true" required="required">
      </dd>
      <dt>
        <label title="" class="hasTip" for="jform_avatar" id="jform_avatar-lbl">Avatar</label>
      </dt>
      <dd>
        <input type="file" size="30" value="" id="jform_avatar" class="" name="jform[avatar]" id="avatar_upload" />
      </dd>
    </dl>
  </fieldset>
  <div>
    <button class="validate" type="submit">Register</button>
    <?php echo JHtml::_('form.token');?>
  </div>
</form>
<?php } else { ?>loggedin<?php } ?>