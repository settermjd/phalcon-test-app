phalcon-test-app
================

A simple application to test developing using Phalcon. It was created to both learn how to use Phalcon and also to support an upcoming article in PHP Architect Magazine.

## Database Installation

Currently there's no automatic database creation. So the following script is required to be run.

    CREATE TABLE `talks` (
     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(70) NOT NULL,
     `starts` datetime NOT NULL,
     `finishes` datetime NOT NULL,
     `created` datetime,
     `updated` datetime,
     PRIMARY KEY (`id`)
    );