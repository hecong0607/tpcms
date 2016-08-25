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
 * @property string $route
 * @property integer $type
 * @property string $left_name
 * @property string $menu_name
 * @property string $remark
 * @property integer $list_order
 * @property string $logo
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
			'route'      => $this->route,
			'type'       => $this->type,
			'left_name'  => $this->left_name,
			'menu_name'  => $this->menu_name,
			'remark'     => $this->remark,
			'list_order' => $this->list_order,
			'logo'       => $this->logo,
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
		if (empty($this->route)) {
			$this->msg->status = false;
			$this->msg->content = '路由不可为空！';
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
		$data = [];
		$base = '&nbsp;&nbsp;&nbsp;';
		$before = '&nbsp;&nbsp;&nbsp;';
		$type = 2;
		$this->recursion(0, $data, $base, $before, $type);
		$this->msg->data = $data;
		return $this->msg;
	}

	/**
	 * 递归：行结构
	 * @param int $id
	 * @param $data
	 * @param string $base
	 * @param string $before
	 * @param int $type
	 * @param int $level
	 * @return null
	 */
	protected function recursion($id = 0, &$data, $base = '&nbsp;&nbsp;&nbsp;', $before = '&nbsp;&nbsp;&nbsp;', $type = 2, $level = 1) {
		$where = [
			'parent_id' => $id,
			'type'      => array('ELT', $type),
		];
		$result = $this->where($where)->order('list_order')->select();
		if (empty($result)) {
			return null;
		} else {
			if ($id != 0) {
				$base = $before . $base;
			}
			foreach ($result as $k => &$v) {
				$v['left'] = $base;
				$v['level'] = $level;
				$data[] = $v;
				$this->recursion($v['id'], $data, $base, $before, $type, $level+1);
			}
		}
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
		$data = [];
		$base = '&nbsp;&nbsp;&nbsp;';
		$before = '&nbsp;&nbsp;&nbsp;';
		$type = 2;
		$this->recursion(0, $data, $base, $before, $type);
		$this->msg->data = $data;
		return $this->msg;
	}

	/**
	 * 获取上级选择列表
	 * @return mixed
	 */
	public function getMenuAllForSelect() {

		$data = [];
		$base = '&nbsp;├&nbsp;';
		$before = '&nbsp;│';
		$type = 2;
		$this->recursion(0, $data, $base, $before,$type);
		return $data;
	}

	/**
	 * 获取侧边栏菜单数据，树状
	 * @return array
	 */
	public function getMenuAllForSidebar() {
		$data = [];
		$base = '';
		$before = '';
		$type = 1;
		$this->recursion(0, $data, $base, $before, $type);
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