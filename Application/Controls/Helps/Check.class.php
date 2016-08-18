<?php
namespace Controls\Helps;
/**
 * Class Check
 * @package Controls\Helps
 * 各种验证的通用操作类
 */
class Check
{

	/**
	 * 验证码的验证
	 * @param $code
	 * @param string $id
	 * @return Msg
	 */
	static function verify($code, $id = '') {
		$msg = new Msg();
		if(empty($code)){
			$msg->status = false;
			$msg->content = '验证码不能为空！';
		}else{
			$verify = new \Think\Verify();
			$msg->status = $verify->check($code, $id);
			if($msg->status == false ){
				$msg->content = '验证码错误！';
			}else{
				$msg->content = '验证码正确';
			}
		}
		return $msg;
	}

}