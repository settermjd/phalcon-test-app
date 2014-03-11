<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Talks model
 * CREATE TABLE `talks` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(70) NOT NULL,
    `starts` datetime NOT NULL,
    `finishes` datetime NOT NULL,
    `created` datetime,
    `updated` datetime,
    PRIMARY KEY (`id`)
    );
 */

class Talks extends \Phalcon\Mvc\Model
{

}