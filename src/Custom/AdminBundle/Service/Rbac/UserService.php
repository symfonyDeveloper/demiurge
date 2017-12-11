<?php

namespace Custom\AdminBundle\Service\Rbac;
use Custom\WebBundle\Common\BaseService;
use Custom\WebBundle\Entity\User;

/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 14:47
 */
interface UserService
{
    public function list(User $user, $page, $limit);
    public function add(User $user);
    public function update(User $user);
    public function disable(User $user);
}