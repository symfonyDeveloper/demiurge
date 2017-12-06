<?php

namespace Custom\AdminBundle\Utils;

/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/7/5
 * Time: 16:31
 */
class MenuUtils
{
    private $routeConfig = null;

    public function getRouteFilePath() {
//        $yml = new \Symfony\Component\Yaml\Yaml();
//        $yml->parse('');
        return config('parameter.admin_menu_config_path');
    }
    public function getRouteConfig() {
        if (is_null($this->routeConfig)) {
            return require($this->getRouteFilePath());
        }
        return $this->routeConfig;
    }

    // 获取字分类或同级分类
    public function getChildMenu($route) {
        $config = $this->getRouteConfig();
        if ('admin_index' == $route) {
            return $config['admin'];
        }
        $menu = [];
        foreach ($config as $c) {
            if (isset($c['parent']) && $route == $c['parent']) {
                $menu[] = $c;
            }
        }
        return $menu;
    }

    public function getBrotherMenu($route) {

    }



    public function buildMenu() {

    }
}