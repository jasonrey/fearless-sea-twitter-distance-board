-- Create syntax for TABLE 'poll'
CREATE TABLE `poll` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `count` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'tweet'
CREATE TABLE `tweet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tweetid` bigint(32) NOT NULL,
  `userid` bigint(32) NOT NULL,
  `text` varchar(150) NOT NULL DEFAULT '',
  `date` datetime NOT NULL,
  `distance` float NOT NULL DEFAULT '0',
  `unit` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Create syntax for TABLE 'user'
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` bigint(32) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `screenname` varchar(255) NOT NULL DEFAULT '',
  `avatar` text NOT NULL,
  `cover` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;