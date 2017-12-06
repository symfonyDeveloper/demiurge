<?php

namespace Custom\AdminBundle\Utils;

use Symfony\Component\Yaml\Yaml;

/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/7/6
 * Time: 16:31
 */
class MenuBuilder
{

    private $position = null;

    private $menus = array();

    public function __construct($position)
    {
        $this->position = $position;
    }

    public function getMenuBreadcrumb($code)
    {
        $menus = $this->buildMenus();
        if (empty($menus[$code]) || empty($menus[$code]['parent'])) {
            return array();
        }
        $menu = $menus[$code];
        $paths = array($menus[$code]);

        while(true) {
            $menu = $menus[$menu['parent']];
            if (empty($menu)) {
                break;
            }

            $paths[] = $menu;
            if (empty($menu['parent'])) {
                break;
            }
        }

        $paths = array_reverse($paths);
        return $paths;
    }

    public function getMenuChildren($code, $group = null)
    {
        $menus = $this->buildMenus();

        if (!isset($menus[$code])) {
            return array();
        }

        $children = array();
        foreach ($menus[$code]['children'] as $childCode) {
            if ($group && $menus[$childCode]['group'] != $group) {
                continue;
            }
            $children[] = $menus[$childCode];
        }

        if (!$group) {
            $children = $this->groupMenus($children);
        }

        return $children;
    }

    private function groupMenus($menus)
    {
        $grouped = array();
        foreach ($menus as $menu) {
            $groupIndex = $menu['group'];
            if (empty($grouped[$groupIndex])) {
                $grouped[$groupIndex] = array();
            }
            $grouped[$groupIndex][] = $menu;
        }

        uksort($grouped, function($k1, $k2){
            return $k1 > $k2 ? 1 : -1;
        });

        return $grouped;
    }

    public function buildMenus()
    {
        if ($this->menus) {
            return $this->menus;
        }

        $cacheFile = storage_path('app' . DIRECTORY_SEPARATOR . $this->position .'_menu.php');

        if (file_exists($cacheFile)) {
            return include $cacheFile;
        }

        $menus = $this->loadMenus();

        $i = 1;
        foreach ($menus as $code => &$menu) {
            $menu['code'] = $code;
            $menu['weight'] = $i * 100;
            $menu['children'] = array();
            if (empty($menu['group'])) {
                $menu['group'] = 1;
            }

            $i++;
            unset($menu);
        }
        foreach ($menus as &$menu) {
            if (!empty($menu['before']) && !empty($menus[$menu['before']]['weight'])) {
                $menu['weight'] = $menus[$menu['before']]['weight'] - 1;
            } elseif (!empty($menu['after']) && !empty($menus[$menu['after']]['weight'])) {
                $menu['weight'] = $menus[$menu['after']]['weight'] + 1;
            }
            unset($menu);
        }

        uasort($menus, function($a, $b) {
            return $a['weight'] > $b['weight'] ? 1 : -1;
        });

        foreach ($menus as $code => $menu) {
            if (empty($menu['parent'])) {
                continue;
            }

            if (!isset($menus[$menu['parent']])) {
                continue;
            }

            $menus[$menu['parent']]['children'][] = $code;
        }

        $this->menus = $menus;

        $cache = "<?php \nreturn " . var_export($menus, true) . ';';
        file_put_contents($cacheFile, $cache);

        return $menus;
    }

    public function loadMenus()
    {
        $position = $this->position;
        $configPaths = array();
        $configPaths[] = base_path('resources'. DIRECTORY_SEPARATOR .'route' . DIRECTORY_SEPARATOR . 'menus_' . $position . '.yml');
        $menus = array();
        foreach ($configPaths as $path) {
            if (!file_exists($path)) {
                continue;
            }
            $menu = Yaml::parse(file_get_contents($path));
            if (empty($menu)) {
                continue;
            }

            $menus = array_merge($menus, $menu);
        }
        return $menus;
    }

}