<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/9/25
 * Time: 14:27
 */
$app = AppKernel::instance()->getApp();
$app->get("/", function() use ($app) {
    return  <<<EOF
<!DOCTYPE html>
<html>
    <head>
        <title>Demiurge</title>
        <style>
            html, body { height: 100%; }
            body { margin: 0; padding: 0; width: 100%; display: table; font-weight: 100; font-family: 'Fantasy';}
            .container { text-align: center; display: table-cell; vertical-align: middle; }
            .content { text-align: center; display: inline-block; }
            .title { font-size: 96px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Demiurge</div>
            </div>
        </div>
    </body>
</html>
EOF;
}) ;
$app->get("/_search","Api\\Controller\\Doctrine::_search");
$app->get("/{tableName}/{id}","Api\\Controller\\Doctrine::_get");