<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 10:47
 */

namespace Custom\WebBundle\Service\User\Impl;


use Custom\WebBundle\Common\BaseService;
use Custom\WebBundle\Entity\User;
use Custom\WebBundle\Service\User\UserService;

class UserServiceImpl extends BaseService  implements UserService
{

    public function getUser(int $id) : User
    {
        $dao = $this->getRepository("User");
        return $dao->find($id);
    }

    public function list(): array
    {
        $dao = $this->getRepository("User");
        return $dao->findAll();
    }

}