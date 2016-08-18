<?php
namespace Admin\Controller;

use Admin\Model\AdminMenuRuleModel;

/**
 * 菜单规则类
 * Class MenuController
 * @package Admin\Controller
 */
class MenuController extends Base
{
	/**
	 * 新增页面
	 */
	public function addAction() {
		$this->save();
	}

	/**
	 * 添加数据接口
	 */
	public function doAddAction() {
		$this->doSave();
	}

	/**
	 * 修改页面
	 */
	public function saveAction() {
		$id = I('get.id', 0);
		$this->save($id);
	}

	/**
	 * 修改数据接口
	 */
	public function doSaveAction() {
		$id = (int)I('post.id');
		$this->doSave($id);
	}

	/**
	 * 显示详情页面
	 */
	public function showAction() {
		$menuModel = new AdminMenuRuleModel();
		$id = I('get.id', 0);
		$msgData = $menuModel->getData($id);
		$this->assign('data', $msgData->data);
		$this->display('Menu/show');
	}

	/**
	 * 列表页面
	 */
	public function listAction() {
		$menuModel = new AdminMenuRuleModel();
		$msgData = $menuModel->getList();
		$this->assign(array('list' => $msgData->data['list'], 'page' => $msgData->data['page']));
		$this->display('Menu/list');
	}

	/**
	 * 删除数据接口
	 */
	public function delAction() {
		$id = I('get.id');
		$menuModel = new AdminMenuRuleModel();
		$msgDel = $menuModel->del($id);
		if ($msgDel->status == false) {
			$this->error($msgDel->content);
		} else {
			$this->success($msgDel->content);
		}
	}

	/**
	 * 显示所有静态的ico
	 */
	public function iconsAction() {
		$this->display('Menu/icons');
	}

	/**
	 * 接收页面传递数据
	 * @param AdminMenuRuleModel $MenuModel
	 */
	protected function postMenu(AdminMenuRuleModel &$MenuModel) {
		$MenuModel->parent_id = I('post.parent_id');
		$MenuModel->module = I('post.module');
		$MenuModel->controller = I('post.controller');
		$MenuModel->action = I('post.action');
		$MenuModel->type = I('post.type');
		$MenuModel->status = I('post.status');
		$MenuModel->menu_name = I('post.menu_name');
		$MenuModel->remark = I('post.remark');
		$MenuModel->list_order = I('post.list_order');
		$MenuModel->logo = I('post.logo');
		$MenuModel->level = I('post.level');
	}

	/**
	 * 修改和保存操作封装
	 * @param string $id
	 */
	protected function doSave($id = '') {
		if (IS_POST) {
			$MenuModel = new AdminMenuRuleModel();
			$MenuModel->id = $id;
			$this->postMenu($MenuModel);
			$msgSave = $MenuModel->doSave();
			if ($msgSave->status == false) {
				$this->error($msgSave->content);
			} else {
				$this->success($msgSave->content, U('Admin/Menu/list'));
			}
		} else {
			$this->error('保存失败！', U('Admin/Menu/save'));
		}
	}

	/**
	 * 修改和保存页面封装
	 * @param string $id
	 */
	protected function save($id = '') {
		$MenuModel = new AdminMenuRuleModel();
		$menu = $MenuModel->getMenuAllForSelect();
		$msgData = $MenuModel->getData($id);
		$this->assign('data', $msgData->data);
		$this->assign('menu', $menu);
		$this->display('Menu/save');
	}

}