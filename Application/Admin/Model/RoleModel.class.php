<?php
namespace Admin\Model;

use Common\Controls\Model;

/**
 * Class RoleModel
 * @package Admin\Model
 *
 * @property integer $id
 * @property string $name
 * @property string $power
 * @property integer $status
 * @property string $remark
 * @property integer $create_time
 * @property integer $update_time
 */
class RoleModel extends Model
{
	protected $tableName = 'admin_role';

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
				$result = $this->add($data);
			} else {
				$result = $this->where(array('id' => $this->id))->save($data);
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
		$data = $this->where(array('id' => $id))->find();
		if (empty($data)) {
			$this->msg->status = false;
			$this->msg->content = '角色不存在！';
		} else {
			$this->msg->status = true;
			$this->msg->data = $data;
		}
		return $this->msg;
	}

	/**
	 * 获取数据，并分页，返回数据
	 * @return \Controls\Helps\Msg
	 */
	public function getList() {
		$count = (int)$this->count();
		$Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
		$list = $this->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$data = array(
			'page' => $Page->show(),
			'list' => $list,
		);
		$this->msg->data = $data;
		return $this->msg;
	}

	/**
	 * 删除数据逻辑，返回删除结果
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function del($id) {
		$this->id = $id;
		$result = $this->delete($id);
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
		$where = array(
			'id' => $this->id,
		);
		$result = $this->where($where)->data($data)->save();
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
		$where = array(
			'status' => 1,
		);
		$data = $this->where($where)->field('id,name')->order('id')->select();
		if (empty($data)) {
			$this->msg->data = array();
		} else {
			$this->msg->data = $data;
		}
		return $this->msg;
	}

}