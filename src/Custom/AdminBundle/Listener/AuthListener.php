<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 14:36
 */

namespace Custom\AdminBundle\Listener;


use Custom\WebBundle\Entity\User;
use Custom\WebBundle\Traits\Service\SysServiceTrait;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthListener implements EventSubscriberInterface
{
    use SysServiceTrait;

    /**
     * 后台菜单权限校验
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $request = $event->getRequest();
        $routeName = $request->get("_route");
        // 判断是否是后台菜单
        $routeList = $this->getSystemService()->getAllRoutes();
        if (!in_array($routeName, $routeList)) {
            return ;
        }
        // 获取当前用户
        $container = \ServiceKernel::instance()->getContainer();
        if (null === $token = $container->get('security.token_storage')->getToken()) {
            $event->setResponse(new Response("拒绝访问", 403));
            return;
        }
        if (!is_object($user = $token->getUser())) {
            $event->setResponse(new Response("拒绝访问", 403));
            return;
        }

        // TODO 权限校验
        return;
    }
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        // 路由监听的优先级是32， 在路由处理完之后处理
        // security.token_storage 服务是8，要初始化用户之后运行
        return array(
            KernelEvents::REQUEST => array(
                ['onKernelRequest', 7],
            ),
        );
    }
}