<?php

namespace Custom\AdminBundle\Controller;

use Custom\WebBundle\Common\BaseController;
use Custom\WebBundle\Utils\R;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            //$result =$dao->find(1);
            $result = $this->getDoctrine()->getRepository("CustomWebBundle:User")->listUser(10, 0);
            return new JsonResponse(R::success($result));
        }
        return $this->render('CustomAdminBundle:Default:index.html.twig');
    }
}
