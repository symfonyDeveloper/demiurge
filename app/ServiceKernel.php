<?php

use Symfony\Component\Translation\Exception\NotFoundResourceException;
/**
 * serviceKernel
 * 单例模式，减少各个类的依赖
 *
 * User: zhangxingz
 * Date: 2017/11/20
 * Time: 14:28
 */
class ServiceKernel
{

    private static $_instance;

    private $container;
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

    /**
     * @return {@inheritdoc}
     */
    public function getContainer()
    {
        return $this->getKernel()->getContainer();
    }



    /**
     * 获取responsitory
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getService($service) {
        $topName = 'Custom';
        if (strpos(":", $service)) {
            list($topName, $service) = explode(":", $service, 2);
        }
        $bundleName = "WebBundle";
        $className = explode(".", $service, 3);
        if (count($className) == 3) {
            $bundleName = current($className);
        }
        $class = $topName . "\\" . $bundleName . "\\Service\\" . $className[count($className) - 2] . "\\Impl\\" . $className[count($className) - 1] . "Impl";
        if (class_exists($class)) {
            return new $class;
        }

        throw new NotFoundResourceException("Service not fount!");
    }
}