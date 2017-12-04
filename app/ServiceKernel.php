<?php

/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/11/20
 * Time: 14:28
 */
class ServiceKernel
{
    private static $_instance;

    /**
     * @var AppKernel
     */
    private $kernel;
    /**
     * @return $this
     */
    public static function instance()
    {
        if (empty(self::$_instance)) {
            throw new \RuntimeException('初始化失败');
        }
        return self::$_instance;
    }

    public static function create(AppKernel $appKernel)
    {
        if (self::$_instance) {
            return self::$_instance;
        }

        $instance = new self();
        $instance->kernel = $appKernel;
        self::$_instance = $instance;
        return $instance;
    }

    /**
     * @return AppKernel
     */
    public function getKernel(): AppKernel
    {
        return $this->kernel;
    }

    /**
     * @param AppKernel $kernel
     */
    public function setKernel(AppKernel $kernel)
    {
        $this->kernel = $kernel;
    }


}