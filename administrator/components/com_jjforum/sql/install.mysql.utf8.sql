CREATE TABLE IF NOT EXISTS `#__jjforum_user` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`avatar` VARCHAR(255)  NOT NULL ,
`points` INT(66)  NOT NULL ,
`facebook_id` INT(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jjforum_category` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`title` VARCHAR(255)  NOT NULL ,
`description` TEXT(65535)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`params` TEXT(65535)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `#__jjforum_post` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL DEFAULT '1',
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`pid` INT(255)  NOT NULL ,
`catid` INT(11)  NOT NULL ,
`user_id` INT(255)  NOT NULL ,
`title` VARCHAR(255)  NOT NULL ,
`text` TEXT(65535)  NOT NULL ,
`tags` TEXT(65535)  NOT NULL ,
`image` VARCHAR(255)  NOT NULL ,
`votes` INT(11)  NOT NULL ,
`created_date` DATETIME NOT NULL ,
`video_id` INT(11)  NOT NULL ,
`video_provider` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;

