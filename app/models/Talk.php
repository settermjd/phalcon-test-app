<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

use \Phalcon\Mvc\Model\Behavior\Timestampable;

class Talk extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->addBehavior(new Timestampable(
            array(
                'beforeUpdate' => array(
                    'field' => 'updated',
                    'format' => 'Y-m-d H:m:i'
                ),
                'beforeCreated' => array(
                    'field' => 'created',
                    'format' => 'Y-m-d H:m:i'
                )
            )
        ));
    }
}