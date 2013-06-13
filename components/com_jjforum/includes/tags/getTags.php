<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */
// no direct access
define( 'JPATH_BASE', realpath(dirname(__FILE__).'/../../../..' ));
define( 'DS', DIRECTORY_SEPARATOR );
include_once ( JPATH_BASE .DS.'components'.DS.'com_jjforum'.DS.'includes'.DS.'lib'.DS.'main_frame.php' );

if($user->id != 0){
	$q = JRequest::getVar('q');
	
	$db = JFactory::getDBO();
	$query	= $db->getQuery(true);
	$query->select("id, name");
	$query->from("#__jjforum_tags");
	$query->where("name LIKE '%%%".$q."%%%' ");

	$db->setQuery((string)$query);
	if (!$db->query()) {
		echo $db->getErrorMsg();
	}

	$tagsArr = $db->loadObjectList();
	$tagsJSON = json_encode($tagsArr);
	echo $tagsJSON;
}
?>
