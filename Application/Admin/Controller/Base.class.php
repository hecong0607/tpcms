<?php
namespace Admin\Controller;

use Admin\Model\AdminModel;
use Admin\Model\AdminRoleModel;
use Think\Controller;

/**
 * Class Base
 * @package Admin\Controller
 * 后台公用控制器基类
 */
class Base extends Controller
{
	function __construct() {
		parent::__construct();
		$this->checkIsLogin();
	}

	/**
	 * 验证是否是登录状态
	 */
	public function checkIsLogin() {
		$userModel = new AdminModel();
		$msgRouter = $userModel->checkRouter();
		if ($msgRouter->status == false) {        //验证路由
			$msgIsLogin = $userModel->checkIsLogin();
			if ($msgIsLogin->status == false) {    //验证登录
				$this->error('暂未登录',U('Admin/Public/login'));
				die();
			}
			$roleModel = new AdminRoleModel();
			$power = MODULE_NAME . '_' . CONTROLLER_NAME . '_' . ACTION_NAME;
			$msgPower = $roleModel->checkRoleByPower($power);
			if ($msgPower->status == false) {
				$this->error($msgPower->content,U('Admin/Home/main'));
			}
		}
	}

	public function _empty() {
		$controller = new HomeController();
		$controller->mainAction();
//		header('location: '.U('Home/main'));
	}
}