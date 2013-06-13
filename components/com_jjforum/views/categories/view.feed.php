<?php
/**
 * @version		$Id: view.feed.php 21589 2011-06-20 17:38:33Z chdemko $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * HTML View class for the Content component
 *
 * @package		Joomla.Site
 * @subpackage	com_content
 * @since 1.5
 */
class JjforumViewCategories extends JView
{
	function display()
	{
		$app = JFactory::getApplication();

		$doc	= JFactory::getDocument();
		$params = $app->getParams();
		$feedEmail	= (@$app->getCfg('feed_email')) ? $app->getCfg('feed_email') : 'author';
		$itemid = JRequest::getVar('Itemid');
		// Get some data from the model
		JRequest::setVar('limit', $app->getCfg('feed_limit'));
		$category		= $this->get('Item');
		$rows		= $this->get('Items');

	//	$doc->link = JRoute::_(ContentHelperRoute::getCategoryRoute($category->id));

		foreach ($rows as $row)
		{
			// strip html from feed item title
			$title = $this->escape($row->title);
			$title = html_entity_decode($title, ENT_COMPAT, 'UTF-8');
			// url link to article
			$link = JRoute::_('index.php?option=com_jjforum&view=post&id='.$row->id.'&Itemid='.$itemid);
			//index.php?option=com_jjforum&view=posts&catid=1&Itemid=469#post213
			// strip html from feed item description text
			// TODO: Only pull fulltext if necessary (actually, just get the necessary fields).
			$description	= $row->text;
			$author			= '';
			@$date			= ($row->created_date ? date('r', strtotime($row->created_date)) : '');

			// load individual item creator class
			$item = new JFeedItem();
			$item->title		= $title;
			$item->link			= $link;
			$item->description	= $description;
			$item->date			= $date;
			$item->category		= $category->title;

			$item->author		= $author;
			if ($feedEmail == 'site') {
				$item->authorEmail = $siteEmail;
			}
			else {
				$item->authorEmail = $row->author_email;
			}

			// loads item info into rss array
			$doc->addItem($item);
		}
	}
}
