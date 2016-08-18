<?php
namespace Admin\Controller;

use Admin\Model\AdminMenuRuleModel;
use Admin\Model\SystemModel;

class HomeController extends Base
{
	/**
	 * 后台登录后的主页
	 */
	public function indexAction() {
		$menuModel = new AdminMenuRuleModel();
		$menu = $menuModel->getMenuAllForSidebar();
		$this->assign('menu',$menu);
		$this->display('Home/index');
	}

	/**
	 * 登录后主页的iframe中的主页
	 */
	public function mainAction(){
		$system = new SystemModel();
		$msgSystem = $system->getData();
		$this->assign('info',$msgSystem->data);
		$this->display('Home/main');
	}

}