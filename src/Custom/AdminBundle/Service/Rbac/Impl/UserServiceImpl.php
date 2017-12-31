<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 14:49
 */

namespace Custom\AdminBundle\Service\Rbac\Impl;


use Custom\AdminBundle\Service\Rbac\UserService;
use Custom\WebBundle\Common\BaseService;
use Custom\WebBundle\Entity\User;

class UserServiceImpl extends BaseService  implements UserService
{
    public function list(User $user, $page, $limit)
    {
    }

    public function add(User $user)
    {
        // TODO: Implement add() method.
    }

    public function update(User $user)
    {
        // TODO: Implement update() method.
    }

    public function disable(User $user)
    {
        // TODO: Implement disable() method.
    }

    private function createQuery() {

    }
}