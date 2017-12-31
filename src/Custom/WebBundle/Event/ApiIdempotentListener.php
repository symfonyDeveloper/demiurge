<?php

namespace Custom\WebBundle\Event;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\VarDumper\VarDumper;

/**
 * 接口幂等性 校验
 * User: zhangxingz
 * Date: 2017/11/24
 * Time: 15:49
 */
class ApiIdempotentListener implements EventSubscriberInterface
{
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        // get 请求不处理
        if ($event->getRequest()->isMethod(Request::METHOD_GET)) {
            return;
        }

        $request = $event->getRequest();

        $cacheDir = \ServiceKernel::instance()->getKernel()->getCacheDir();
        $cache = new FilesystemAdapter("api", 0, $cacheDir);
        // TODO 加密key 重新处理
        $serialize = serialize($request);
        $obj = $cache->getItem('api.' . md5($serialize));

        if ($obj->get()) {
            $event->setResponse(new Response("", 403));
            return;
        }
        $obj->set(true);
        $cache->save($obj);
    }
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        // 路由监听的优先级是32， 在路由处理完之后处理
        return array(
            KernelEvents::REQUEST => array(
                array('onKernelRequest', 28),
            ),
        );
    }
}