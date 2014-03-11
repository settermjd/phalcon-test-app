<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * The Business Pages Controller
 */
class PagesController extends \Phalcon\Mvc\Controller
{
    public function aboutAction()
    {
        $this->view->cache(true);
    }

    public function privacyAction()
    {

    }

    public function copyrightAction()
    {

    }
}