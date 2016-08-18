<?php
namespace Admin\Model;

use Controls\Apps\Model;

class AdminRoleModel extends Model
{
	protected $tableName = 'admin_role';

	/**************************
	 *        数据字典（修改数据表时，需要修改）
	 **************************/

	public $id = '';
	public $name = '';
	public $power = '';
	public $status = '';
	public $remark = '';
	public $create_time = '';
	public $update_time = '';

	/**************************
	 *        增
	 **************************/

	/**************************
	 *        删
	 **************************/

	/**************************
	 *        改
	 **************************/

	/**
	 * 修改数据（只修改power）
	 * @param array $data
	 * @return bool
	 */
	private function modelDoSaveForPower(array $data) {
		$where = array(
			'id' => $this->id,
		);
		$result = $this->where($where)->data($data)->save();
		return $result;
	}

	/**************************
	 *        查
	 **************************/

	/**
	 * 查找数据，分页，并返回
	 * @return array
	 */
	private function modelGetList() {
		$count = (int)$this->count();
		$Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
		$list = $this->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$data = array(
			'page' => $Page->show(),
			'list' => $list,
		);
		return $data;
	}

	/**
	 * 获取新增和修改的选择数据
	 * @return mixed
	 */
	private function modelGetDataAllForSelect() {
		$where = array(
			'status' => 1,
		);
		$data = $this->where($where)->field('id,name')->order('id')->select();
		return $data;
	}

	/********************************************
	 *********************************************
	 *         逻辑数据处理
	 ********************************************
	 ********************************************/

	//不需要验证的路由
	private $Router = array(
		array('module' => 'Admin', 'controller' => 'Home', 'action' => 'index'),
		array('module' => 'Admin', 'controller' => 'Home', 'action' => 'main'),
		array('module' => 'Admin', 'controller' => 'Public', 'action' => 'logout'),
	);

	/**
	 * 验证保存的数据（新增和修改）
	 */
	protected function checkSave() {
		$this->msg->status = true;
		if (empty($this->name)) {
			$this->msg->status = false;
			$this->msg->content = '角色名称不可为空！';
			return;
		}
	}

	/**
	 * 保存操作（新增和修改）
	 * @return \Controls\Helps\Msg
	 */
	public function doSave() {
		$this->checkSave();
		if ($this->msg->status == true) {
			$data = array(
				'name'        => $this->name,
				'status'      => $this->status,
				'remark'      => $this->remark,
				'create_time' => $this->create_time,
				'update_time' => $this->update_time,
			);
			if (empty($this->id)) {
				$result = $this->modelDoAdd($data);
			} else {
				$result = $this->modelDoSave($data);
			}
			if ($result === false) {
				$this->msg->status = false;
				$this->msg->content = '保存失败！';
			} else {
				$this->msg->status = true;
				$this->msg->content = '保存成功';
			}
		}
		return $this->msg;
	}

	/**
	 * 根据id获取的一条数据
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function getDataById($id) {
		$data = $this->modelGetDataById($id);
		if (empty($data)) {
			$this->msg->status = false;
			$this->msg->content = '角色不存在！';
		} else {
			$this->msg->status = true;
			$data['power'] = explode(',', $data['power']);
			$this->msg->data = $data;
		}
		return $this->msg;
	}

	/**
	 * 获取数据，并分页，返回数据
	 * @return \Controls\Helps\Msg
	 */
	public function getList() {
		$data = $this->modelGetList();
		$this->msg->data = $data;
		return $this->msg;
	}

	/**
	 * 删除数据逻辑，返回删除结果
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function del($id) {
		$result = $this->modelDel($id);
		if ($result == false) {
			$this->msg->status = false;
			$this->msg->content = '删除失败！';
		} else {
			$this->msg->status = true;
			$this->msg->content = '删除成功！';
		}
		return $this->msg;
	}

	/**
	 * 设置权限操作
	 */
	public function setPowerForRole() {
		$data = array(
			'power' => implode(',', $this->power),
		);
		$result = $this->modelDoSaveForPower($data);
		if ($result === false) {
			$this->msg->status = false;
			$this->msg->content = '保存失败！';
		} else {
			$this->msg->status = true;
			$this->msg->content = '保存成功';
		}
		return $this->msg;
	}

	/**
	 * 权限验证
	 * @param $check
	 * @return \Controls\Helps\Msg
	 */
	public function checkRoleByPower($check) {
		//超级管理员分组不需要验证
		$role = session('role');
		if ($role['id'] == 1) {
			$this->msg->status = true;
		} else {
			//过滤不需要验证的路由
			$this->msg->status = false;
			foreach ($this->Router as $v) {
				if ($check == $v['module'] . '_' . $v['controller'] . '_' . $v['action']) {
					$this->msg->status = true;
				}
			}
			if ($this->msg->status == false) {
				$power = $role['power'];
				if (stripos($power, $check) === false) {
					$this->msg->status = false;
					$this->msg->content = '权限不足！';
				} else {
					$this->msg->status = true;
				}
			}
		}
		return $this->msg;
	}

	/**
	 * 获取角色选择列表
	 * @return mixed
	 */
	public function getRoleAllForSelect() {
		$data = $this->modelGetDataAllForSelect();
		if (empty($data)) {
			$this->msg->data = array();
		} else {
			$this->msg->data = $data;
		}
		return $this->msg;
	}
}