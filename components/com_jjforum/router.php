<?php
/**
 * @version     1.0.0
 * @package     com_jjforum
 * @copyright   Copyright JJextensions (C) 2012. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Created by com_combuilder - http://www.notwebdesign.com
 */

/**
 * @param	array	A named array
 * @return	array
 */
function JjforumBuildRoute(&$query)
{
	$segments = array();

	if (isset($query['view'])) {
		$segments[] = $query['view'];
		unset($query['view']);
	}
	if (isset($query['tag'])) {
		$segments[] = $query['tag'];
		unset($query['tag']);
	}
	if (isset($query['id'])) {
		$segments[] = $query['id'];
		unset($query['id']);
	}

	return $segments;
}

/**
 * @param	array	A named array
 * @param	array
 *
 * Formats:
 *
 * index.php?/banners/task/id/Itemid
 *
 * index.php?/banners/id/Itemid
 */
function JjforumParseRoute($segments)
{
   $vars = array();
   switch($segments[0])
   {
	   case 'posts':
			   $vars['view'] = 'posts';
			   $id = explode( ':', $segments[1] );
			   $vars['id'] = (int) $id[0];
			   break;
	   case 'post':
			   $vars['view'] = 'post';
			   $id = explode( ':', $segments[1] );
			   $vars['id'] = (int) $id[0];
			   break;
	   case 'tags':
			   $vars['view'] = 'tags';
			   if(isset($segments[1]))
			   $vars['tag'] = $segments[1];
			   break;
   }
   return $vars;
}
