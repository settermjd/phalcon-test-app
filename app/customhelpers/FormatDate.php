<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for file
 */

class FormatDate extends \Phalcon\Tag
{
    /**
     * Formats a date in a simple way
     *
     * @param array
     * @return string
     */
    static public function simpleFormat($dateTime)
    {
        $date = new DateTime($dateTime);
        return $date->format('D jS Y - H:i');
    }

}