<?php
namespace Admin\Controller;

use Admin\Model\RoleModel;
use Admin\Model\UserModel;
use Think\Controller;

/**
 * Class Base
 * @package Admin\Controller
 * 后台公用控制器基类
 */
class Base extends Controller
{
    function __construct()
    {
        parent::__construct();
        $this->checkIsLogin();
    }

    /**
     * 验证是否是登录状态
     */
    public function checkIsLogin()
    {
        $userModel = new UserModel();
        $url = '/' . MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
        $msgRouter = $userModel->checkRouter($url);
        if ($msgRouter->status == false) {        //验证路由（到时候是否修改到配置文件中）
            $msgIsLogin = $userModel->checkIsLogin();
            if ($msgIsLogin->status == false) {    //验证登录
                $this->error('暂未登录', U('Admin/Public/login'));
                die();
            }
            $this->authority($url);
        }
    }

    /**
     * 所有已知类的不存在方法
     */
    public function _empty()
    {
        $this->noFund();
    }

    /**
     * 展示404页面
     */
    protected function noFund()
    {
        $this->assign('error', '页面未找到！');
        $this->display('Public/error');
    }

    /**
     * 展示错误页面
     * @param $content
     */
    private function noPermissions($content)
    {
        $this->assign('error', $content);
        $this->display('Public/error');
    }

    /**
     * 权限验证
     * @param $url
     */
    private function authority($url)
    {
        $roleModel = new RoleModel();
        $msgPower = $roleModel->checkRoleByPower($url);        //权限验证
        if ($msgPower->status == false) {
            $this->noPermissions($msgPower->content);
            die;
        }
    }

    /**
     * 获取登录者信息
     * @return string
     */
    public function getMyInfo(){
        $user = new UserModel();
        $data = $user->getMyData()->data;
        return $data;
    }
}