<?php
namespace Admin\Controller;

use Admin\Model\MenuRuleModel;
use Admin\Model\RoleModel;

class RoleController extends Base
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
		$id = I('post.id');
		$this->doSave($id);
	}

	/**
	 * 显示详情页面
	 */
	public function showAction() {
		$roleModel = new RoleModel();
		$id = I('get.id', 0);
		$msgData = $roleModel->getDataById($id);
		$this->assign('data', $msgData->data);
		$this->display('Role/show');
	}

	/**
	 * 列表页面
	 */
	public function listAction() {
		$roleModel = new RoleModel();
		$msgRole = $roleModel->getList();
		$this->assign(array('list' => $msgRole->data['list'], 'page' => $msgRole->data['page']));
		$this->display('Role/list');
	}

	/**
	 * 删除数据接口
	 */
	public function delAction() {
		$id = I('get.id');
		$roleModel = new RoleModel();
		$msgDel = $roleModel->del($id);
		if ($msgDel->status == false) {
			$this->error($msgDel->content);
		} else {
			$this->success($msgDel->content);
		}
	}

	/**
	 * 设置权限页面
	 */
	public function setPowerAction() {
		$id = (int)I('get.id');
		$roleModel = new RoleModel();
		$roleData = clone $roleModel->getDataById($id);
		if ($roleData->status == false) {
			$this->error($roleData->content, 'Admin/Role/list');
		} else {
			$menuModel = new MenuRuleModel();
			$MenuList = clone $menuModel->getMenuAll();
			$this->assign('roleData', $roleData->data);
			$this->assign('ruleList', $MenuList->data);
			$this->display('Role/setPower');
		}
	}

	/**
	 * 设置权限操作
	 */
	public function doSetPowerAction() {
		$roleModel = new RoleModel();
		$roleModel->id = I('post.id');
		$roleModel->power = I('post.power');
		$msgSet = $roleModel->setPowerForRole();
		if ($msgSet->status == false) {
			$this->error($msgSet->content);
		} else {
			$this->success($msgSet->content);
		}
	}


	/**
	 * 接收页面传递数据
	 * @param RoleModel $roleModel
	 */
	protected function postData(RoleModel &$roleModel) {
		$roleModel->name = I('post.name');
		$roleModel->status = I('post.status');
		$roleModel->remark = I('post.remark');
	}

	/**
	 * 修改和保存操作封装
	 * @param string $id
	 */
	protected function doSave($id = '') {
		if (IS_POST) {
			$roleModel = new RoleModel();
			$roleModel->id = $id;
			$this->postData($roleModel);
			$msgSave = $roleModel->doSave();
			if ($msgSave->status == false) {
				$this->error($msgSave->content);
			} else {
				$this->success($msgSave->content, U('Admin/Role/list'));
			}
		} else {
			$this->error('保存失败！', U('Admin/Role/save'));
		}
	}

	/**
	 * 修改和保存页面封装
	 * @param string $id
	 */
	protected function save($id = '') {
		$roleModel = new RoleModel();
		$msgData = $roleModel->getDataById($id);
		$this->assign('data', $msgData->data);
		$this->display('Role/save');
	}

}