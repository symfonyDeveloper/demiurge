<?php

namespace Custom\WebBundle\Controller;

use Custom\WebBundle\Common\BaseController;
use Custom\WebBundle\Common\BaseService;

class DefaultController extends BaseController
{

    public function indexAction()
    {
/*        $baseService = new BaseService();
        $repo = $baseService->getRepository("User");
        $user = $repo->find(1);
        $this->dump($user);*/
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
