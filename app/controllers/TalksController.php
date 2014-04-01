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

    public function addAction()
    {
        $talk = new Talk();
        $form = new TalksForm();
        $this->view->form = $form;

        if ($this->request->isPost() == true) {
            $form->bind($_POST, $talk);
            if ($form->isValid()) {
                $talk->save();
            }
        }
    }

    public function editAction()
    {
        $talk = Talk::find(array(
            "conditions" => "id = ?1",
            "bind"       => array(1 => $this->dispatcher->getParam("id"))
        ))->getFirst();

        if (!$talk) {
            $response = new \Phalcon\Http\Response();
            return $response->redirect(array(
                "for" => "talks-add"
            ));
        }

        $form = new TalksForm($talk);
        $this->view->form = $form;

        if ($this->request->isPost() == true) {
            $form->bind($_POST, $talk);
            if ($form->isValid()) {
                $talk->save();
            }
        }
    }
}