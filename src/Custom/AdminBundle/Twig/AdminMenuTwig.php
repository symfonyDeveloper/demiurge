<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/6
 * Time: 17:04
 */

namespace Custom\AdminBundle\Twig;


use Custom\WebBundle\Traits\Service\SysServiceTrait;

class AdminMenuTwig extends \Twig_Extension
{
    public static $menus;
    use SysServiceTrait;


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('generate_first_menu', array($this, 'createFirstMenu')),
            new \Twig_SimpleFilter('generate_second_menu', array($this, 'createSecondMenu')),
        );
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('generate_first_menu', array($this, 'createFirstMenu')),
            new \Twig_SimpleFunction('generate_second_menu', array($this, 'createSecondMenu'))
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
            if ($menu->getParentId() == $firstMenuId) {
                array_push($menuList, $menu);
            }
        }
        return $menuList;
    }

    public function getName()
    {
        return 'generate_menu';
    }
}