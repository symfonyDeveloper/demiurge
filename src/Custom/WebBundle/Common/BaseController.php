<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 10:29
 */

namespace Custom\WebBundle\Common;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function dump($object, $exit = true) {
        dump($object);
        if ($exit) {
            exit();
        }
    }

}