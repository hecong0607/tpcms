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
		$this->msg = new Msg();
	}


}