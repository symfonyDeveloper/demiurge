<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 12:51
 */

namespace Custom\AdminBundle\Controller;


use Custom\AdminBundle\Entity\AppUsers;
use Custom\AdminBundle\Entity\SysRole;
use Custom\AdminBundle\Form\UserType;
use Custom\AdminBundle\Service\Rbac\Dao\Impl\UserDaoImpl;
use Custom\WebBundle\Common\BaseController;
use Custom\AdminBundle\Utils\Perm;
use Custom\WebBundle\Traits\Service\SysServiceTrait;
use Custom\WebBundle\Utils\DateUtils;
use Custom\WebBundle\Utils\R;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * 角色管理
 * Class RoleManagerController
 * @package Custom\AdminBundle\Controller
 */
class RoleManagerController extends BaseController
{

    use SysServiceTrait;
    /**
     * @Perm admin_role_list
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $sql = "select u from CustomAdminBundle:SysRole u";
        $query = $this->getDoctrine()->getManager()->createQuery($sql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt("page", 1),
            $request->query->getInt("limit", 5)
        );
        return $this->render("CustomAdminBundle:Role:index.html.twig", [
            "pagination" => $pagination
        ]);
    }

    /**
     * @Perm admin_role_add
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request) {
        if ($request->getMethod() == Request::METHOD_GET) {
            return $this->render("CustomAdminBundle:Role:add.html.twig");
        }
        $role = new SysRole();
        $role->setRoleName($request->get("role_name"));
        $role->setRemark($request->get("remark"));
        $role->setCreateUserId($this->getUser()->getId());
        $role->setCreateTime(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($role);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_role_list"));
    }


    /**
     * @Perm admin_role_update
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $role = $em->getRepository("CustomAdminBundle:SysRole")->find($request->get("id"));
        if ($request->getMethod() == Request::METHOD_POST) {
            $role->setRoleName($request->request->get("role_name"));
            $role->setRemark($request->request->get("remark"));
            $em->flush();
            // TODO 角色菜单
            $conn = $this->get('database_connection');
            $sql = "delete from sys_role_menu where role_id = :roleId ";
            $conn->executeQuery($sql, ["roleId" =>  $role->getId()]);
            $menuList = $request->get("menu");
            foreach ($menuList as $roleId) {
                $sql = "INSERT INTO sys_role_menu(role_id, menu_id) VALUES (:roleId, :menuId)";
                $conn->executeQuery($sql, [
                    "roleId" => $role->getId(),
                    "menuId" => $roleId
                ]);
            }
            return $this->redirect($this->generateUrl("admin_role_list"));
        }
        $firstMenu = $this->getDoctrine()->getManager()->getRepository("CustomAdminBundle:SysMenu")->findBy([
            "parentId" => 0
        ]);
        $roleMenu = $em->getRepository("CustomAdminBundle:SysRoleMenu")->findBy(["roleId"  => $request->get("id")]);
        $roleMenuIds = [];
        foreach ($roleMenu as $item) {
            array_push($roleMenuIds, $item->getMenuId());
        }
        return $this->render("CustomAdminBundle:Role:update.html.twig", [
            "role" => $role,
            "firstMenu" => $firstMenu,
            "roleMenuIds" => $roleMenuIds ?? []
        ]);
    }

    /**
     * @Perm admin_role_disable
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request) {
        return $this->redirect($this->generateUrl("admin_role_list"));
    }
}