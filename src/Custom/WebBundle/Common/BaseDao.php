<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/5
 * Time: 19:43
 */

namespace Custom\WebBundle\Common;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;

class BaseDao
{

    public function getContainer() {
        return \ServiceKernel::instance()->getContainer();
    }

    /**
     * @return Registry
     */
    public function getDoctrine() {
        if (!\ServiceKernel::instance()->getContainer()->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return \ServiceKernel::instance()->getContainer()->get('doctrine');
    }


    /**
     * @return \Doctrine\Common\Persistence\ObjectManager|object
     */
    public function getManager() {
        return $this->getDoctrine()->getManager();
    }
    /**
     * @return Object 数据库连接
     */
    public function getConnection() {
        return $this->getDoctrine()->getConnection();
    }

}