<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Short description for file
 */

class TalksController extends \Phalcon\Mvc\Controller
{
    protected $_talks;

    public function indexAction()
    {
        $this->_talks = new Talks();
        $availableTalks = $this->_talks->find(array(
            "cache" => array("key" => "upcoming-talks", "lifetime" => 300)
        ));
        $this->view->setVar("talks", $availableTalks);
    }

    public function archiveAction()
    {
        $this->_talks = new Talks();
        $availableTalks = $this->_talks->find(array(
            "conditions" => "finishes >= ?1",
            "bind"       => array(1 => "now()"),
            "cache"      => array("key" => "archived-talks", "lifetime" => 300)
        ));
        $this->view->setVar("talks", $availableTalks);
    }

    public function viewTalkAction()
    {

    }
}