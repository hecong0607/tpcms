<?php
namespace Admin\Controller;

use Admin\Model\UserModel;
use \Common\Controls\Check;

class PublicController extends Base
{

    //后台登陆界面
    public function loginAction()
    {

        $this->display();
    }

    /**
     * 登录操作
     */
    public function doLoginAction()
    {
        $msgVerify = Check::verify(I('post.verify'));
        if ($msgVerify->status == false) {
            $this->error($msgVerify->content);
            die();
        } else {
            $username = I('post.username');
            $password = I('post.password');
            $userModel = new UserModel();
            $msgDoLogin = $userModel->doLogin($username, $password, $_SERVER['SERVER_ADDR']);
            if ($msgDoLogin->status == true) {
                $this->success($msgDoLogin->content, U('Admin/Home/index'));
                die();
            } else {
                $this->error($msgDoLogin->content);
                die();
            }
        }
    }

    /**
     * 推出登录操作
     */
    public function logoutAction()
    {
        $userModel = new UserModel();
        $userModel->logout();
        header('location: ' . U('Public/login'));
        die;
    }

    /**
     * 显示验证码
     */
    public function verifyAction()
    {
        $Verify = new \Think\Verify();
        // 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
        $Verify->useImgBg = true;
        $Verify->length = 4;
        $Verify->expire = 600;
        $Verify->imageW = 248;
        $Verify->entry();
    }

}