<?php
namespace Controls\Helps;
/**
 * Class Msg
 * @package Helps
 * 消息辅助类，用于各层之间的消息返回
 */
class Msg
{
	public $status = false;
	public $data = array();
	public $content = '';

	/**
	 * 以json形式传回本对象
	 * @return string
	 */
	public function getMsgOfJson() {
		return json_encode($this);
	}
}