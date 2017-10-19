<?php
/**
 * index
 * User: zhangxingz
 * Date: 2017/9/25
 * Time: 14:17
 */

use Symfony\Component\HttpFoundation\Request;
require_once '../vendor/autoload.php';

$request = Request::createFromGlobals();
$kernel = AppKernel::instance("dev", true);
$kernel->regeist();
$kernel->run($request);

