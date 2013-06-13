<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */
// no direct access
define( '_JEXEC', 0 );
define( 'MAIN_FRAME', realpath(dirname(__FILE__).'/../../../..' ));
define( 'MFD', DIRECTORY_SEPARATOR );

require_once ( MAIN_FRAME .MFD.'includes'.MFD.'defines.php' );
require_once ( MAIN_FRAME .MFD.'includes'.MFD.'framework.php' );


$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$user	= JFactory::getUser();

$u =& JURI::getInstance();
$baseuri = $u->toString( array( 'scheme', 'host' ) );
