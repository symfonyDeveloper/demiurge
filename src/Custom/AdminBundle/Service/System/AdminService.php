<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 13:31
 */

namespace Custom\AdminBundle\Service\System;


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

    public function getAllRoutes();
}