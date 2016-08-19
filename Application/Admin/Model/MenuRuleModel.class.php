<?php
namespace Admin\Model;

use Common\Controls\Model;

/**
 * 菜单数据库操作
 * Class AdminMenuRuleModel
 * @package Admin\Model
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property integer $type
 * @property string $menu_name
 * @property string $remark
 * @property integer $list_order
 * @property string $logo
 * @property integer $level
 */
class MenuRuleModel extends Model
{
	protected $tableName = 'admin_menu_rule';

	/********************************************
	 *********************************************
	 *         逻辑数据处理
	 ********************************************
	 ********************************************/

	/**
	 * 保存操作（新增和修改）
	 * @return \Common\Controls\Msg
	 */
	public function doSave() {
		$this->checkSave();
		$data = array(
			'parent_id'  => $this->parent_id,
			'module'     => $this->module,
			'controller' => $this->controller,
			'action'     => $this->action,
			'type'       => $this->type,
			'status'     => $this->status,
			'menu_name'  => $this->menu_name,
			'remark'     => $this->remark,
			'list_order' => $this->list_order,
			'logo'       => $this->logo,
			'level'      => $this->level,
		);
		if ($this->msg->status == true) {
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
	 * 验证保存的数据（新增和修改）
	 */
	protected function checkSave() {
		$this->msg->status = true;
		if (empty($this->menu_name)) {
			$this->msg->status = false;
			$this->msg->content = '菜单名称不可为空！';
			return;
		}
		if (empty($this->module)) {
			$this->msg->status = false;
			$this->msg->content = '模块不可为空！';
			return;
		}
		if (empty($this->controller)) {
			$this->msg->status = false;
			$this->msg->content = '控制器不可为空！';
			return;
		}
		if (empty($this->action)) {
			$this->msg->status = false;
			$this->msg->content = '操作不可为空！';
			return;
		}
	}

	/**
	 * 根据id获取的一条数据
	 * @param $id
	 * @return \Common\Controls\Msg
	 */
	public function getData($id) {
		$data = $this->where(array('id' => $id))->find($id);
		if (empty($data)) {
			$this->msg->status = false;
		} else {
			$this->msg->status = true;
			$this->msg->data = $data;
		}
		return $this->msg;
	}

	/**
	 * 获取数据，并分页，返回数据
	 * @return \Common\Controls\Msg
	 */
	public function getList() {
		$count = (int)$this->count();
		$Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
		$list = $this->order('list_order,id')->limit($Page->firstRow . ',' . $Page->listRows)->select();
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
	 * @return \Common\Controls\Msg
	 */
	public function del($id) {
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
	 * 返回所有的菜单数据
	 * @return mixed
	 */
	public function getMenuAll() {
		$result = $this->order('list_order')->select();
		$this->msg->data = $result;
		return $this->msg;
	}

	/**
	 * 获取上级选择列表
	 * @return mixed
	 */
	public function getMenuAllForSelect() {
		$where = array(
			'level' => array('in', '1,2,3,4'),
		);
		$data = $this->where($where)->field('id,menu_name,level')->order('list_order')->select();
		foreach ($data as $k => &$v) {
			if ($v['level'] == 1) {
				$v['menu_name'] = '&nbsp;├&nbsp;' . $v['menu_name'];
			} elseif ($v['level'] == 2) {
				$v['menu_name'] = '&nbsp;│&nbsp;├&nbsp;' . $v['menu_name'];
			} elseif ($v['level'] == 3) {
				$v['menu_name'] = '&nbsp;│&nbsp;│&nbsp;├&nbsp;' . $v['menu_name'];
			} elseif ($v['level'] == 4) {
				$v['menu_name'] = '&nbsp;│&nbsp;│&nbsp;│&nbsp;├&nbsp;' . $v['menu_name'];
			}
		}
		return $data;
	}

	/**
	 * 获取侧边栏菜单数据，树状
	 * @return array
	 */
	public function getMenuAllForSidebar() {
		$where = array(
			'level'  => array('in', '1,2,3'),
			'status' => 1,
		);
		$data = $this->where($where)->order('list_order')->select();
		$menu = $this->generateTree($this->setKeyById($data));
		return $menu;
	}

	/**
	 * 喳喳的二维数组转多叉树，二维数组的key需要与id一致
	 * @param $items
	 * @return array
	 */
	private function generateTree($items) {
		foreach ($items as $item)
			$items[$item['parent_id']]['items'][$item['id']] = &$items[$item['id']];
		return isset($items[0]['items']) ? $items[0]['items'] : array();
	}

	/**
	 * 将二维数组的一维key设置成该数据的id的value
	 * @param $data
	 * @return array
	 */
	private function setKeyById($data) {
		$arr = array();
		foreach ($data as $k => $v) {
			$arr[$v['id']] = $v;
		}
		return $arr;
	}

}