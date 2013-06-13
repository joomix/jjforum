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
<div class="JJlogin">
  <form onsubmit="logginAjax(this); return false;">
    <fieldset>
      <div class="login-fields">
        <label class="" for="username" id="username-lbl">User Name</label>
        <input type="text" size="25" class="validate-username" value="" id="username" name="username">
      </div>
      <div class="login-fields">
        <label class="" for="password" id="password-lbl">Password</label>
        <input type="password" size="25" class="validate-password" value="" id="password" name="password">
      </div>
      <button class="button" type="submit">Log in</button>
      <?php echo JHtml::_('form.token'); ?>
    </fieldset>
  </form>
</div>
<?php //echo $FBlogin; ?>
<?php } else { ?>loggedin<?php } ?>