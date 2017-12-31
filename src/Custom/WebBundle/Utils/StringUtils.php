<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/13
 * Time: 9:55
 */

namespace Custom\WebBundle\Utils;


class StringUtils
{

    /**
     * 判断是否为空
     *
     * @param $string
     * @return bool
     */
    public static function isBlack($string) {
        return empty($string);
    }

    /**
     * 判断是否不为空
     *
     * @param $string
     * @return bool
     */
    public static function isNotBlack($string) {
        return !StringUtils::isBlack($string);
    }

    /**
     * 判断是否是邮箱地址
     *
     * @param $email string 邮箱
     * @return boolean
     */
    public static function isEmail($email) {
        if (!is_string($email)) {
            throw new \Exception("参数异常, 参数必须是字符串");
        }
        if (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
            return true;
        }
        return false;
    }

    /**
     * 校验手机号 （如需添加号段，在对应数组内添加）
     *
     * @param $string string|integer 手机号
     * @return bool
     */
    public static function isMobile($string) {
        // 移动号码号段
        $chinaMobileArr = [139,138,137,136,135,134,150,151,152,157,158,159,182,183,187,188,147];
        // 联通号码号段
        $chinaUnicomArr = [130,131,132,136,185,186,145];
        // 电信号码号段
        $chinaTelecomArr = [133,153,180,189];

        // 避免传错参数不是字符串或数据报错
        if (!is_numeric($string) || strlen($string) != 11) {
            return false;
        }

        if (!in_array(substr($string, 0, 3), array_merge($chinaMobileArr, $chinaUnicomArr, $chinaTelecomArr))) {
            return false;
        }
        return true;
    }

    /**
     * 判断开头是否有
     *
     * @param $string string 字符串
     * @param $need string 搜索字符串
     * @return bool
     */
    public static function beginWith($string, $need) {
        if (!is_string($string) || !is_string($need)) {
            throw new \Exception("参数异常, 参数必须是字符串");
        }
        if (strpos($string, $need) == 0) {
            return true;
        }
        return false;
    }

    /**
     * 判断字符串中是否包含指定字符串
     *
     * @param $string
     * @param $need
     */
    public static function contains($string, $need) {
        if (!is_string($string) || !is_string($need)) {
            throw new \Exception("参数异常, 参数必须是字符串");
        }
        if (strpos($string, $need)) {
            return true;
        }
        return false;
    }

    /**
     * 判断字符串中是否包含指定字符串，忽略大小写
     *
     * @param $string
     * @param $need
     */
    public static function containsIgnoreCase($string, $need) {
        if (!is_string($string) || !is_string($need)) {
            throw new \Exception("参数异常, 参数必须是字符串");
        }
        return StringUtils::contains(strtolower($string), strtolower($need));
    }

    /**
     * 移除字符串指定部分
     *
     * @param $string
     * @param $remove
     * @return mixed
     * @throws \Exception
     */
    public static function remove($string, $remove) {
        if (!is_string($string) || !is_string($remove)) {
            throw new \Exception("参数异常, 参数必须是字符串");
        }
        return StringUtils::replace($string, $remove, "");
    }

    /**
     * 替换字符串指定部分
     *
     * @param $string
     * @param $search
     * @param $replace
     * @return mixed
     * @throws \Exception
     */
    public static function replace($string, $search, $replace) {
        if (!is_string($string) || !is_string($search) || !is_string($replace)) {
            throw new \Exception("参数异常, 参数必须是字符串");
        }
        return str_replace($search, $replace, $string);
    }

    /**
     * 左补全
     *
     * @param $string
     * @param $length
     * @param string $padString
     * @return string
     */
    public static function leftPad($string, $length, $padString = "0") {
        return str_pad($string, $length, $padString, STR_PAD_LEFT);
    }

    /**
     * 右补全
     *
     * @param $string
     * @param $length
     * @param string $padString
     * @return string
     */
    public static function rightPad($string, $length, $padString = "0") {
        return str_pad($string, $length, $padString, STR_PAD_RIGHT);
    }


}