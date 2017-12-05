<?php

namespace Custom\AdminBundle\Controller;

use Custom\WebBundle\Common\BaseController;

class DefaultController extends BaseController
{
    public function indexAction()
    {
        return $this->render('CustomAdminBundle:Default:index.html.twig');
    }
}
