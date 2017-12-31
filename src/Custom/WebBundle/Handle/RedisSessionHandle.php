<?php

namespace Custom\WebBundle\Handle;

use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeSessionHandler;

/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/11/20
 * Time: 16:23
 */
class RedisSessionHandle extends NativeSessionHandler
{
    public function __construct($savePath)
    {
        if (!extension_loaded('redis')) {
            throw new \RuntimeException('PHP does not have "redis" session module registered');
        }
        ini_set('session.save_handler', 'redis');
        ini_set('session.save_path', $savePath);
        ini_set('session.gc_maxlifetime', 3600 * 24 * 15);
        // session id 有效期
        session_set_cookie_params(3600 * 24 * 15);
    }
}