<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 13:46
 */

namespace Custom\WebBundle\Traits\Service;


trait SysServiceTrait
{
    /**
     * @return \Custom\AdminBundle\Service\System\AdminService
     */
    public function getSystemService() {
        return \ServiceKernel::instance()->getService("AdminBundle.System.AdminService");
    }
}