<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 10:46
 */

namespace Custom\WebBundle\Service\User;


use Custom\WebBundle\Entity\User;

interface UserService
{
    /**
     * @param $id
     * @return User
     */
    public function getUser(int $id);

    /**
     * @return array User
     */
    public function list();
}