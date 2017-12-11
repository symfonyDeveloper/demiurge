<?php

namespace AppBundle\Controller;

use Custom\WebBundle\Common\BaseController;
use Custom\WebBundle\Utils\AesUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $response = $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
        $response->setSharedMaxAge(3600);
        $response->setMaxAge(3600);
//        if (!empty($request->getETags()) && current($request->getETags()) == md5($response->getContent()))
//        {
            $response->setNotModified();
            $response->setETag(md5($response->getContent()));
//        }

        return $response;
    }
}
