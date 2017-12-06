<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/7/6
 * Time: 16:34
 */

namespace Custom\AdminBundle\Utils;

use Symfony\Component\Yaml\Yaml;

class MenuExtension
{

    protected $menuUtil = null;

    protected $builders = array();

    // 生成url
    public function getMenuPath($menu, $context = [])
    {
        $route = empty($menu['router_name']) ? $menu['code'] : $menu['router_name'];
        $params = empty($menu['router_params']) ? array() : $menu['router_params'];

        if (!empty($menu['router_params_context'])) {
            foreach ($params as $key => $value) {
                $value = explode('.', $value, 2);
                $params[$key] = $context['_context'][$value[0]][$value[1]];

            }
        }

        return route($route, $params);
    }

    // 黑名单
    public function inMenuBlacklist($code = '')
    {
        if(empty($code)){
            return false;
        }
        //$filename = $this->container->getParameter('kernel.root_dir') . '/../app/config/menu_blacklist.yml';
        $filename = '/1.yml';
        if(!file_exists($filename)){
            return false;
        }
        $yaml = new Yaml();
        $blackList = $yaml->parse(file_get_contents($filename));
        if(empty($blackList)){
            $blackList = array();
        }
        return in_array($code, $blackList);
    }

    // 获取子路由
    public function getMenuChildren($position, $code, $group = null)
    {
        return $this->createMenuBuilder($position)->getMenuChildren($code, $group);
    }

    // 获取路由面包屑
    public function getMenuBreadcrumb($position, $code)
    {
        return $this->createMenuBuilder($position)->getMenuBreadcrumb($code);
    }

    private function createMenuBuilder($position)
    {
        if (!isset($this->builders[$position])) {
            $this->builders[$position] = new MenuBuilder($position);
        }
        return $this->builders[$position];
    }
}