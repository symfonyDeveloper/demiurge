<?php

namespace Custom\AdminBundle\Controller;

use Custom\WebBundle\Common\BaseController;
use Custom\WebBundle\Entity\User;
use Custom\WebBundle\Traits\Service\SysServiceTrait;
use Custom\WebBundle\Utils\R;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Custom\AdminBundle\Utils\Perm;

class DefaultController extends BaseController
{
    use SysServiceTrait;

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function indexAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $result = $this->getDoctrine()->getRepository("CustomWebBundle:User")->listUser(10, 0);
            return new JsonResponse(R::success($result));
        }

        return $this->render('CustomAdminBundle:Default:index.html.twig');
    }


    /**
     * @Perm user_manager
     * @return Response
     */
    public function testAction(Request $request) {
        return new Response("test");
    }
}
