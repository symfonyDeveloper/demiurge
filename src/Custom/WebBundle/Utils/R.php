<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/4
 * Time: 13:25
 */

namespace Custom\WebBundle\Utils;


class R
{
    const SUCCESS_CODE = 0;
    const ERROR_CODE = 500;
    const ERROR_MSG = "程序异常";

    public $code;

    public $msg;

    public $data;


    /**
     * @param int $code
     * @param array $data
     * @return R
     */
    public static function success($data = [], $code = R::SUCCESS_CODE) {
        $response = new self();
        $response->setCode($code);
        $response->setData($data);
        return $response;
    }

    /**
     * @param $code
     * @param string $msg
     * @return R
     */
    public static function error($code, $msg = self::ERROR_MSG) {
        $response = new self();
        $response->setCode($code);
        $response->setMsg($msg);
        return $response;
    }

    public function addExt($key, $value) {
        $this->setExt($key, $value);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


    /**
     * @param mixed $ext
     * @return R
     */
    public function setExt($key, $value)
    {
        $this->$key = $value;
        return $this;
    }



}