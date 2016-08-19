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
	function __construct() {
		parent::__construct();
		$this->checkIsLogin();
	}

	/**
	 * 验证是否是登录状态
	 */
	public function checkIsLogin() {
		$userModel = new UserModel();
		$msgRouter = $userModel->checkRouter();
		if ($msgRouter->status == false) {        //验证路由（到时候是否修改到配置文件中）
			$msgIsLogin = $userModel->checkIsLogin();
			if ($msgIsLogin->status == false) {    //验证登录
				$this->error('暂未登录', U('Admin/Public/login'));
				die();
			}
			$roleModel = new RoleModel();
			$power = MODULE_NAME . '_' . CONTROLLER_NAME . '_' . ACTION_NAME;
			$msgPower = $roleModel->checkRoleByPower($power);        //权限验证
			if ($msgPower->status == false) {
				$this->noPermissions($msgPower->content);
				die;
			}
		}
	}

	public function _empty() {
		$this->noFund();
	}

	protected function noFund(){
		$this->assign('error','页面未找到！');
		$this->display('Public/error');
	}

	private function noPermissions($content){
		$this->assign('error','无权限！');
		$this->display('Public/error');
	}

	/**
	 * 权限验证
	 */
	private function authority() {
		$roleModel = new RoleModel();
		$power = MODULE_NAME . '_' . CONTROLLER_NAME . '_' . ACTION_NAME;
		$msgPower = $roleModel->checkRoleByPower($power);        //权限验证
		if ($msgPower->status == false) {
			$this->noPermissions($msgPower->content);
			die;
			$this->error($msgPower->content, U('Admin/Home/main'));
		}
	}
}