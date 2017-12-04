<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/11/20
 * Time: 14:10
 */

function aesEncode($privateKey, $iv, $data) {
    $string = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $privateKey, $data, MCRYPT_MODE_CBC, $iv);
    return urlencode(base64_encode($string));
}

function aesDecode($privateKey, $iv, $data) {
    $string = urldecode(base64_decode($data));
    return mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $string, MCRYPT_MODE_CBC, $iv);
}