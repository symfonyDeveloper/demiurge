<?php

namespace Custom\AdminBundle\Service\Rbac\Dao\Impl;
use Custom\AdminBundle\Service\Rbac\Dao\UserDao;
use Custom\WebBundle\Common\BaseDao;

/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 15:35
 */
class UserDaoImpl extends BaseDao implements UserDao
{
    public function listUser($page, $limit)
    {
        $sql = "select u from CustomAdminBundle:AppUsers u";
        $query = $this->getManager()->createQuery($sql);
        $paginator  = $this->getContainer()->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            $limit
        );
        return $pagination;
    }

}