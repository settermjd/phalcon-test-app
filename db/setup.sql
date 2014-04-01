CREATE TABLE `talks` (
     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(70) NOT NULL,
     `starts` datetime NOT NULL,
     `finishes` datetime NOT NULL,
     `created` datetime,
     `updated` datetime,
     PRIMARY KEY (`id`)
);