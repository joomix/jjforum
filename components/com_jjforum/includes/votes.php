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

$params = JRequest::getVar('params');
$param = explode('~',$params);
$id = $param[0];
$votes = $param[1];
$type = $param[2];
($type == 'plus') ? $votes++ : $votes--;

$db = JFactory::getDBO();
$query	= $db->getQuery(true);
$query = "UPDATE #__jjforum_post SET votes = '$votes' WHERE id = '$id'";

$db->setQuery($query);
if (!$db->query()) {
	echo $db->getErrorMsg();
}
echo $votes;
?>
