<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 14:36
 */

namespace Custom\AdminBundle\Listener;


use Custom\AdminBundle\Utils\DocParser;
use Custom\WebBundle\Traits\Service\SysServiceTrait;
//use Doctrine\Common\Annotations\DocParser;
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
        $parse = new DocParser();
        $_controller = $request->get("_controller");
        if (!strpos($_controller, "::")) {
            return ;
        }
        list($controllerClass , $method) = explode("::", $_controller);
        $class = new \ReflectionClass($controllerClass);
        $doc = $class->getMethod($method)->getDocComment();
        $info = $parse->parse($doc);
        $perm = $info["Perm"] ?? false;

        if (!$perm) {
            return ;
        }
        // 判断是否是后台菜单
        $routeList = $this->getSystemService()->getAllPerms();
        if (!in_array($perm, $routeList)) {
            return ;
        }
        // 获取当前用户
        $container = \ServiceKernel::instance()->getContainer();
        if (null === $token = $container->get('security.token_storage')->getToken()) {
            $event->setResponse(new Response("未登录，拒绝访问", 403));
            return;
        }
        if (!is_object($user = $token->getUser())) {
            $event->setResponse(new Response("未登录，拒绝访问", 403));
            return;
        }

        // TODO 权限校验
        $userMenuList = $this->getSystemService()->getUserPerms($user->getId());

        if (!in_array($perm, $userMenuList)) {
            $event->setResponse(new Response("没有菜单权限，拒绝访问", 403));
            return;
        }
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