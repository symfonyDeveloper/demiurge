<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 15:29
 */

namespace Custom\WebBundle\Traits\Service;


trait UserServiceTrait
{
    /**
     * @return \Custom\WebBundle\Service\User\UserService
     */
    public function getUserService() {
        return \ServiceKernel::instance()->getService("User.UserService");
    }
}