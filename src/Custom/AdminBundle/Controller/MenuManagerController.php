<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 12:51
 */

namespace Custom\AdminBundle\Controller;


use Custom\AdminBundle\Entity\AppUsers;
use Custom\AdminBundle\Entity\SysMenu;
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
class MenuManagerController extends BaseController
{

    use SysServiceTrait;
    /**
     * @Perm admin_menu_list
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request) {
        $sql = "select u from CustomAdminBundle:SysMenu u";
        $query = $this->getDoctrine()->getManager()->createQuery($sql);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt("page", 1),
            $request->query->getInt("limit", 10)
        );
        return $this->render("CustomAdminBundle:Menu:index.html.twig", [
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
            $firstMenuList = $this->getDoctrine()->getRepository("CustomAdminBundle:SysMenu")->findBy(["type" => 0]);
            $secondMenuList = $this->getDoctrine()->getRepository("CustomAdminBundle:SysMenu")->findBy(["type" => 1]);
            return $this->render("CustomAdminBundle:Menu:add.html.twig", [
                "firstMenuList" => $firstMenuList,
                "secondMenuList" => $secondMenuList
            ]);
        }
        $menu = new SysMenu();
        $menu->setParentId($request->get("parent_id", 0));
        $menu->setName($request->get("name"));
        $menu->setUrl($request->get("url", ""));
        $menu->setPerms($request->get("perms"));
        $menu->setType($request->get("type"));
        $menu->setIcon($request->get("icon"));
        $menu->setOrderNum($request->get("order_num"));
        $em = $this->getDoctrine()->getManager();
        $em->persist($menu);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_menu_list"));
    }


    /**
     * @Perm admin_role_update
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        /**
         * @var $menu SysMenu
         */
        $menu = $em->getRepository("CustomAdminBundle:SysMenu")->find($request->get("id"));
        if ($request->getMethod() == Request::METHOD_POST) {
            $menu->setParentId($request->request->get("parentId"));
            $menu->setName($request->request->get("name"));
            $menu->setUrl($request->request->get("url", ""));
            $menu->setPerms($request->request->get("perms"));
            $menu->setType($request->request->get("type"));
            $menu->setIcon($request->request->get("icon"));
            $menu->setOrderNum($request->request->get("order_num"));
            $em->flush();
            return $this->redirect($this->generateUrl("admin_menu_list"));
        }
        $firstMenuList = $this->getDoctrine()->getRepository("CustomAdminBundle:SysMenu")->findBy(["type" => 0]);
        $secondMenuList = $this->getDoctrine()->getRepository("CustomAdminBundle:SysMenu")->findBy(["type" => 1]);
        return $this->render("CustomAdminBundle:Menu:update.html.twig", [
            "menu" => $menu,
            "firstMenuList" => $firstMenuList,
            "secondMenuList" => $secondMenuList
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