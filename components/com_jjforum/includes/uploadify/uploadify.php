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
define('JPATH_BASE', realpath(dirname(__FILE__).'/../../../..' ));
define( 'MFD', DIRECTORY_SEPARATOR );

require_once ( MAIN_FRAME .MFD.'includes'.MFD.'defines.php' );
require_once ( MAIN_FRAME .MFD.'includes'.MFD.'framework.php' );
require_once ( 'class.upload.php' );

$mainframe =& JFactory::getApplication('site');
$mainframe->initialise();
$user	= JFactory::getUser();
jimport('joomla.filesystem.file');

if($user->id != 0){
	if (!empty($_FILES)){

		//handle the directory for images
		$dir_dest = JPATH_SITE . MFD . "images" . MFD. "jjforum" ;
		$watermark   = MAIN_FRAME . MFD . 'components' . MFD . 'com_jjforum' . MFD . 'includes' . MFD . "uploadify" . MFD . "zoom.png";
		if(!JFolder::exists($dir_dest)){
			JFolder::create($dir_dest, '0755');
			$contact = "<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>";
			JFile::write($dir_dest . "/index.html", $contact);
		}

		
		$handle = new upload($_FILES['image']);
		if ($handle->uploaded) {
			//handle the thumbnail image
			$handle->image_resize            = true;
			$handle->image_ratio_y           = true;
			$handle->image_x                 = 123;
			$handle->image_watermark       = $watermark;
			$handle->image_watermark_x     = 10;
			$handle->image_watermark_y     = 10;
			$handle->file_name_body_pre = 'thumb_';
			$handle->Process($dir_dest);
			
			//handle the large image
			$handle->image_resize            = true;
			$handle->image_ratio_y           = true;
			if($handle->image_src_x > 600){
				$handle->image_x                 = 600;		
			}
	//		$handle->image_max_width = 800;
	//		$handle->file_max_size = '10024'; 
			$handle->Process($dir_dest);
	
			// we check if everything went OK
			if (!$handle->processed){
				// one error occured
				$handle->error;
			}
		
			// we delete the temporary files
			$handle->Clean();
			echo $handle->file_dst_name;
		} else {
			echo 'no upload: '.$handle->error;	
		}
	}
}

?>