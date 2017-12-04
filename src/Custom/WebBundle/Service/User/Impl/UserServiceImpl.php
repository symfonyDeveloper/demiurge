<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 10:47
 */

namespace Custom\WebBundle\Service\Impl;


use Custom\WebBundle\Common\BaseService;
use Custom\WebBundle\Service\User\UserService;

class UserServiceImpl extends BaseService  implements UserService
{
    public function getUser($id)
    {
        $dao = $this->getEm()->getRepository("User");
        return $dao->find($id);
    }

}