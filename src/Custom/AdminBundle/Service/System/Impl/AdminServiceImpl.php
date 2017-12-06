<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 13:33
 */

namespace Custom\AdminBundle\Service\System\Impl;


use Custom\AdminBundle\Entity\SysMenu;
use Custom\AdminBundle\Entity\SysUserRole;
use Custom\AdminBundle\Entity\SysRoleMenu;
use Custom\AdminBundle\Service\System\AdminService;
use Custom\WebBundle\Common\BaseService;

//todo 添加缓存
class AdminServiceImpl extends BaseService implements AdminService
{
    public function getUserRoles(int $userId)
    {
        $userRoleRepository = $this->getRepository("CustomAdminBundle:SysUserRole");
        $roles = $userRoleRepository->findBy(["userId" => $userId]);

        $roleRep = $this->getRepository("CustomAdminBundle:SysRole");
        $roleList = [];
        /**
         * @var $role SysUserRole
         */
        foreach ($roles as $role) {
            $r = $roleRep->find($role->getRoleId());
            array_push($roleList, $r);
        }
        return $roleList;
    }

    public function getUserMenus(int $userId)
    {
        $roles = $this->getUserRoles($userId);
        $roleMenuRepo = $this->getRepository("CustomAdminBundle:SysRoleMenu");
        $menuRepo = $this->getRepository("CustomAdminBundle:SysMenu");

        $menuIds = [];
        foreach ($roles as $role) {
            $roleMenuList = $roleMenuRepo->findBy(["roleId" => $role->getId()]);

            /**
             * @var $item SysRoleMenu
             */
            foreach ($roleMenuList as $item) {
                array_push($menuIds, $item->getMenuId());
            }
        }

        $menuList=  [];
        foreach ($menuIds as $menuId) {
            $menu = $menuRepo->find($menuId);
            array_push($menuList, $menu);
        }
        return array_filter($menuList);
    }

    public function getUserPerms(int $userId)
    {
        $menus = $this->getUserMenus($userId);
        /**
         * @var $menu SysMenu
         */
        $perms = [];
        foreach ($menus as $menu) {
            array_push($perms, $menu->getPerms());
        }
        return array_unique($perms);
    }

    public function getAllRoutes()
    {
        $menuRepo = $this->getRepository("CustomAdminBundle:SysMenu");
        $roleList = $menuRepo->findAll();
        $perms = [];
        /**
         * @var $menu SysMenu
         */
        foreach ($roleList as $menu) {
            array_push($perms, $menu->getPerms());
        }
        return array_unique($perms);
    }
}