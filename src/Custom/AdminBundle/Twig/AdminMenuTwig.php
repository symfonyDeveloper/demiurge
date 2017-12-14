<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 17:04
 */

namespace Custom\AdminBundle\Twig;


use Custom\WebBundle\Traits\Service\SysServiceTrait;
use Symfony\Component\HttpFoundation\Request;

class AdminMenuTwig extends \Twig_Extension
{
    public static $menus;
    use SysServiceTrait;


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('generate_first_menu', array($this, 'createFirstMenu')),
            new \Twig_SimpleFilter('generate_second_menu', array($this, 'createSecondMenu')),
            new \Twig_SimpleFunction('get_current_route', array($this, 'getCurrentRoute')),
            new \Twig_SimpleFunction('get_parent_route', array($this, 'getParentRoute'))
        );
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('generate_first_menu', array($this, 'createFirstMenu')),
            new \Twig_SimpleFunction('generate_second_menu', array($this, 'createSecondMenu')),
            new \Twig_SimpleFunction('get_current_route', array($this, 'getCurrentRoute')),
            new \Twig_SimpleFunction('get_parent_route', array($this, 'getParentRoute')),
            new \Twig_SimpleFunction('get_menu_bread', array($this, 'getMenuBread'))
        );
    }

    public function createFirstMenu($userId)
    {
        self::$menus = $this->getSystemService()->getUserMenus($userId);
        $ret = [];
        foreach (self::$menus as $item) {
            if ($item->getParentId() == 0) {
                array_push($ret, $item);
            }
        }
        return $ret;
    }

    public function createSecondMenu($firstMenuId) {
        $menuList = [];

        foreach (self::$menus as $menu) {
            if (!is_null($menu) && $menu->getParentId() == $firstMenuId) {
                array_push($menuList, $menu);
            }
        }
        return $menuList;
    }

    public function getCurrentRoute(Request $request) {
        $route = $request->get('_route');
        return $this->getSystemService()->getRouteByUrl($route);
    }

    public function getParentRoute($url) {
        return $this->getSystemService()->getParentRouteByUrl($url);
    }

    public function getMenuBread(Request $request) {
        $menuList = [];
        $menu = $this->getSystemService()->getRouteByUrl($request->get("_route"));
        array_push($menuList, $menu);
        if ($menu && $menu->getParentId() != 0) {
            $menu = $this->getSystemService()->getParentRouteByUrl($menu->getUrl());
            array_push($menuList, $menu);
        }
        if ($menu && $menu->getParentId() != 0) {
            $menu = $this->getSystemService()->getParentRouteByUrl($menu->getUrl());
            array_push($menuList, $menu);
        }
        return array_reverse($menuList);
    }

    public function getName()
    {
        return 'generate_menu';
    }
}