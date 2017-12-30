CREATE TABLE `hashtag` (
    `hashtag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `hashtag` varchar(255) NOT NULL,
    PRIMARY KEY (`hashtag_id`),
    UNIQUE KEY `hashtag` (`hashtag`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
