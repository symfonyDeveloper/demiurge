<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/9/25
 * Time: 16:47
 */

namespace Api\Controller;


use Api\Utils\R;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Doctrine
{
    public function _search(Application $app, Request $request)
    {
        return "_search";
    }

    public function _get(Application $app, $tableName, $id) {
        try {
            $sql = "select * from {$tableName} where id = ?";
            $res = $app['db']->fetchArray($sql, [$id]);
        } catch (\Exception $e) {
            return R::error($e->getCode(), $e->getMessage());
        }
        return R::ok($res);
    }

    public function _post(Application $app, Request $request) {

    }

    public function _put(Application $app, Request $request) {

    }

    public function _delete(Application $app, Request $request) {

    }
}