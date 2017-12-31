<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 13:31
 */

namespace Custom\AdminBundle\Service\System;


use Custom\AdminBundle\Entity\SysMenu;

interface AdminService
{

    /**
     * 获取用户角色列表
     *
     * @param int $userId
     * @return array The SysRole
     */
    public function getUserRoles(int $userId);

    /**
     * 获取用户菜单
     *
     * @param int $userId
     * @return array The SysMenu
     */
    public function getUserMenus(int $userId);

    /**
     * 获取用户权限
     * @param int $userId
     * @return array
     */
    public function getUserPerms(int $userId);

    /**
     * @return array The perm string
     */
    public function getAllPerms();

    public function getAllMenu();
    /**
     * @param $url
     * @return SysMenu
     */
    public function getRouteByUrl($url);

    /**
     * @param $url
     * @return SysMenu
     */
    public function getParentRouteByUrl($url);
}