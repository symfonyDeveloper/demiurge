<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/9/25
 * Time: 14:32
 */
class AppKernel
{
    /**
     * @var Silex\Application
     */
    private $app;

    /**
     * @var Symfony\Component\EventDispatcher\EventDispatcher
     */
    private static $_dispatcher;

    /**
     * @var $this
     */
    private static $_instance;

    /**
     * @var array
     */
    private $parameters;

    private function __construct($env, $debug)
    {
        $this->app = new Silex\Application();
        $this->app['debug'] = $debug;
        $this->app['env'] = $env;
    }

    /**
     * @return $this
     */
    public static function instance($env  = "prod", $debug = false)
    {
        if (self::$_instance) {
            return self::$_instance;
        }

        $instance = new self($env, $debug);
        self::$_instance = $instance;
        return $instance;
    }

    /**
     * 注册服务
     */
    public function regeist() {
        $this->regeistRoutes();
        // 加载数据库
        $this->app->register(new Silex\Provider\DoctrineServiceProvider(), $this->getParameter("db") );
        // 加载日志
        $this->app->register(new Silex\Provider\MonologServiceProvider(), array(
            'monolog.logfile' => $this->getLogDir() . DIRECTORY_SEPARATOR . $this->app['env'] . '.log',
        ));
        // 控制器
        $this->app->register(new Silex\Provider\ServiceControllerServiceProvider());
    }

    /**
     * 注册路由
     */
    public function regeistRoutes() {
        require_once $this->getAppDir() . '/config/routes.php';
    }
    /**
     * 获取配置目录
     */
    public function getAppDir() {
        return __DIR__ . '/../app';
    }

    public function getLogDir() {
        return __DIR__ . '/../var/log';
    }

    public function getParameter($name) {
        if (empty($this->parameters)) {
            $this->parameters = require_once $this->getAppDir() . '/config/config.php';
        }

        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        throw new \Symfony\Component\Routing\Exception\InvalidParameterException("No parameter was found");
    }

    public function run(Request $request) {
        $this->app->run($request);
    }

    public static function dispatcher()
    {
        if (self::$_dispatcher) {
            return self::$_dispatcher;
        }

        self::$_dispatcher = new EventDispatcher();

        return self::$_dispatcher;
    }

    public function getApp() {
        return $this->app;
    }
}