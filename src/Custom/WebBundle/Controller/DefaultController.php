<?php

namespace Custom\WebBundle\Controller;

use Custom\WebBundle\Common\BaseController;
use Custom\WebBundle\Common\BaseService;
use Custom\WebBundle\Traits\Service\UserServiceTrait;

class DefaultController extends BaseController
{

    use UserServiceTrait;

    public function indexAction()
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
