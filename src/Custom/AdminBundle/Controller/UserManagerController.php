<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 12:51
 */

namespace Custom\AdminBundle\Controller;


use Custom\AdminBundle\Entity\AppUsers;
use Custom\AdminBundle\Form\UserType;
use Custom\AdminBundle\Service\Rbac\Dao\Impl\UserDaoImpl;
use Custom\WebBundle\Common\BaseController;
use Custom\AdminBundle\Utils\Perm;
use Custom\WebBundle\Traits\Service\SysServiceTrait;
use Custom\WebBundle\Utils\R;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * 用户管理
 * Class UserManagerController
 * @package Custom\AdminBundle\Controller
 */
class UserManagerController extends BaseController
{

    use SysServiceTrait;
    /**
     * @Perm admin_user_list
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $sql = "select u from CustomAdminBundle:AppUsers u";
        $query = $this->getDoctrine()->getManager()->createQuery($sql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt("page", 1),
            $request->query->getInt("limit", 5)
        );
        return $this->render("CustomAdminBundle:User:index.html.twig", [
            "pagination" => $pagination
        ]);
    }

    /**
     * @Perm admin_user_add
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request) {
        if ($request->getMethod() == Request::METHOD_GET) {
            return $this->render("CustomAdminBundle:User:add.html.twig");
        }
        $user = new AppUsers();
        $user->setUsername($request->get("username"));
        $user->setEmail($request->get("email"));
        $user->setPassword(md5($request->get("password")));
        $user->setIsActive(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_user_list"));
    }


    /**
     * @Perm admin_user_update
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("CustomAdminBundle:AppUsers")->find($request->get("id"));
        if ($request->getMethod() == Request::METHOD_POST) {
            $user->setUserName($request->request->get("username"));
            $user->setEmail($request->request->get("email"));
            $user->setPassword(md5($request->request->get("password")));
            $em->flush();
            $conn = $this->get('database_connection');
            $sql = "delete from sys_user_role where user_id = :userId ";
            $conn->executeQuery($sql, ["userId" =>  $user->getId()]);
            $roleList = $request->get("role");
            foreach ($roleList as $roleId) {
                $sql = "INSERT INTO sys_user_role(user_id, role_id) VALUES (:userId, :roleId)";
                $conn->executeQuery($sql, [
                    "userId" => $user->getId(),
                    "roleId" => $roleId
                ]);
            }
            return $this->redirect($this->generateUrl("admin_user_list"));
        }

        $userRole = $this->getSystemService()->getUserRoles($this->getUser()->getId());
        $roleList = $em->getRepository("CustomAdminBundle:SysRole")->findAll();
        $userRoleIds = [];
        foreach ($userRole as $value) {
            array_push($userRoleIds, $value->getId());
        }
        return $this->render("CustomAdminBundle:User:update.html.twig", [
            "user" => $user,
            "userRole" => $userRoleIds,
            "roleList" => $roleList
        ]);
    }

    /**
     * @Perm admin_user_disable
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function disaableAction(Request $request) {
        return $this->redirect($this->generateUrl("admin_user_list"));
    }
}