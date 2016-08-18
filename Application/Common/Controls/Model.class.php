<?php
namespace Common\Controls;
use Think\Model as TpModel;

/**
 * Class Model
 * @package Controls\Helps
 * model的公用基类
 * 相对tp的model，添加了msg成员对象
 */
class Model extends TpModel
{
	public $msg;
	public $default_page = 30;
	public static $ddefault_page = 30;

	function __construct() {
		parent::__construct();
		//初始化消息类成员
		$this->msg = new \Controls\Helps\Msg();
	}

	/**************************
	 *        增
	 **************************/

	/**
	 * 添加数据
	 * @param array $data
	 * @return mixed
	 */
	protected function modelDoAdd(array $data) {
		$result = $this->data($data)->add();
		return $result;
	}

	/**************************
	 *        删
	 **************************/

	/**
	 * 根据id删除数据
	 * @param $id
	 * @return mixed
	 */
	protected function modelDel($id) {
		$where = array(
			'id' => $id,
		);
		$result = $this->where($where)->delete();
		return $result;
	}

	/**************************
	 *        改
	 **************************/

	/**
	 * 修改数据
	 * @param array $data
	 * @return bool
	 */
	protected function modelDoSave(array $data) {
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
	 * 根据id获取一条数据
	 * @param $id
	 * @return mixed
	 */
	protected function modelGetDataById($id) {
		$where = array(
			'id' => $id,
		);
		$data = $this->where($where)->find();
		return $data;
	}

}