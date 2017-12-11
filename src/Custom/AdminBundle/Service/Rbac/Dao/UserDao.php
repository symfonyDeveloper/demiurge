<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 15:35
 */

namespace Custom\AdminBundle\Service\Rbac\Dao;


interface UserDao
{
    public function listUser($page, $limit);
}