<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/13
 * Time: 10:50
 */

namespace Custom\WebBundle\Utils;


class DateUtils
{
    const DATE_FORMAT = 'Y-m-d';

    const TIME_FORMAT = 'H:i:s';

    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * 获取当前时间 （年-月-日）
     *
     * @return string
     */
    public static function getCurrentDate() {
        return (new \DateTime())->format(DateUtils::DATE_FORMAT);
    }

    /**
     * 获取当前日期 (年-月-日  时:分:秒)
     *
     * @return string
     */
    public static function getCurrentDateTime() {
        return (new \DateTime())->format(DateUtils::DATE_TIME_FORMAT);
    }

    /**
     * 获取当前日期 （时:分:秒）
     * @return string
     */
    public static function getCurrentTime() {
        return (new \DateTime())->format(DateUtils::TIME_FORMAT);
    }

    /**
     * 获取当前年份
     *
     * @return string
     */
    public static function getYear() {
        return (new \DateTime())->format("Y");
    }

    /**
     * 获取当前月份
     *
     * @return string
     */
    public static function getMonth() {
        return (new \DateTime())->format("m");
    }

    /**
     * 获取当前日期
     *
     * @return string
     */
    public static function getDay() {
        return (new \DateTime())->format("d");
    }

    /**
     * 时间戳转时间对象
     *
     * @param $time
     * @param $format
     * @return false|string
     */
    public static function timeToDate($time, $format) {
        return date($format, $time);
    }

    /**
     * 时间对象转时间戳
     *
     * @param $date
     * @return int
     */
    public static function dateToTime($date) {
        return (new \DateTime($date))->getTimestamp();
    }
}