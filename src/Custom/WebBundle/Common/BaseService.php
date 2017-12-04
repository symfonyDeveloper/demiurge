<?php
/**
 * Service基类
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 10:30
 */

namespace Custom\WebBundle\Common;


class BaseService
{
    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $em;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer(): \Symfony\Component\DependencyInjection\ContainerInterface
    {
        return \ServiceKernel::instance()->getKernel()->getContainer();
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): \Psr\Log\LoggerInterface
    {
        if (!$this->container->has('logger')) {
            throw new \LogicException('The MonologBundle is not registered in your application.');
        }
        return $this->getContainer()->get("logger");
    }

    /**
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function getDoctrine(): \Doctrine\Bundle\DoctrineBundle\Registry
    {
        if (!$this->getContainer()->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
        }

        return $this->getContainer()->get('doctrine');
    }


    /**
     * 获取responsitory
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($dao) {
        $em = $this->getDoctrine();
        $class = 'CustomWebBundle:';
        return $em->getRepository($class. $dao);
    }
}