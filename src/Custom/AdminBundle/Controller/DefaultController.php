<?php

namespace Custom\AdminBundle\Controller;

use Custom\WebBundle\Common\BaseController;
use Custom\WebBundle\Traits\Service\SysServiceTrait;
use Custom\WebBundle\Utils\R;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends BaseController
{
    use SysServiceTrait;

    public function indexAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $result = $this->getDoctrine()->getRepository("CustomWebBundle:User")->listUser(10, 0);
            return new JsonResponse(R::success($result));
        }

        return $this->render('CustomAdminBundle:Default:index.html.twig');
    }

    public function testAction(Request $request) {
        $this->getUser();
        $roles = $this->getSystemService()->getUserPerms(1);
        $this->dump($_SESSION);
        return new Response("<body>1</body>");
    }
}
