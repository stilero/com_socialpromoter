DROP TABLE IF EXISTS `#__com_socialpromoter_queue`;
CREATE TABLE `#__com_socialpromoter_queue` (
    `id` int(11) NOT NULL auto_increment,
    `plugin` varchar(255) default '',
    `title` varchar(255) default '',
    `description` varchar(255) default '',
    `url` varchar(255) NOT NULL default '',
    `tags` varchar(255) default '',
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
    `posted` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `#__com_socialpromoter_logs`;
CREATE TABLE `#__com_socialpromoter_logs` (
    `id` int(11) NOT NULL auto_increment,
    `url` varchar(255) NOT NULL default '',
    `plugin` varchar(255) default '',
    `code` varchar(255) default '',
    `msg` varchar(255) default '',
    `created` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;


