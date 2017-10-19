<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/10/18
 * Time: 17:02
 */
namespace Api\Utils;

use JsonSerializable;
use Symfony\Component\HttpFoundation\JsonResponse;

class R implements JsonSerializable
{
    private $code;
    private $data;
    private $msg;

    public function __construct($data, $code, $msg, $ext = null)
    {
        $this->setData($data);
        $this->setCode($code);
        $this->setMsg($msg);
        if (is_array($ext) || !empty($ext)) {
            foreach ($ext as $key => $item) {
                $this->set($key, $item);
            }
        }
    }

    public static function ok($data = [], $ext = []) {
        $response = new R($data, 200, '', $ext);
        return new JsonResponse($response);
    }

    public static function error($code, $msg) {
        $response = new R([], $code, $msg);
        return new JsonResponse($response);
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

    public function set($key, $value) {
        $this->$key = $value;
    }

    public function jsonSerialize() {
        $data = [];
        foreach ($this as $key=>$val)
        {
            if ($val !== null) $data[$key] = $val;
        }
        return $data;
    }
}