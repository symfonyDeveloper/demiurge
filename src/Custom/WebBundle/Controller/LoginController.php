<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/11/14
 * Time: 17:07
 */

namespace Custom\WebBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class LoginController extends Controller
{
    // 默认跳转路由名称
    private $defaultTargetRoute = 'homepage';
    // 获取跳转地址
    use TargetPathTrait;

    // 登录页面
    public function loginAction(Request $request) {
        // 登录用户直接跳转
        if ($this->getUser()) {
            $referer = $this->getTargetPath($request->getSession(), 'main');
            return $this->redirect($referer);
        }
        return $this->render(
            'CustomWebBundle:Login:login.html.twig'
        );
    }

    // 登录判断
    public function loginCheckAction(Request $request) {
        $userService = $this->getDoctrine()->getManager()->getRepository("CustomWebBundle:User");
        $user = $userService->loadUserByUsername($request->request->get("_username"));
        if (is_null($user)) {
            return new JsonResponse(["success" => false]);
        }
        // 验证密码, 使用hash_equals 防止时序攻击
        if (!hash_equals(md5($request->request->get("_password", "")), $user->getPassword())) {
            return new JsonResponse(["success" => false]);
        }
        // token aes 加密
        $privateKey = substr($this->getParameter("secret"), 0, 16);
        $iv = substr($this->getParameter("secret"), -16, 16);
        $token = aesEncode($privateKey, $iv, $request->request->get("_username"));

        $goto = $this->getTargetPath($request->getSession(), 'main');
        if (!$goto) {
            $goto = $this->getDefaultLoginSuccessUrl();
        }
        $headers = [
            'token' => $token,
            'goto' => $goto,
            'success' => true
        ];
        return new JsonResponse($headers);
    }

    private function getDefaultLoginSuccessUrl() {
        return $this->generateUrl($this->defaultTargetRoute);
    }
}