<?php
namespace Admin\Model\Form\User;

use Admin\Model\UserModel;

/**
 * Class InfoForm
 * @package Admin\Model\Form\User
 *
 * @property string realname
 * @property string phone
 * @property string email
 * @property string qq
 */
class InfoForm extends UserModel
{
	protected $_validate = array(
		array('realname','require','昵称不可为空！'), //默认情况下用正则进行验证
		array('email','require','邮箱不可为空！'), //默认情况下用正则进行验证
	);
	/**
	 * 个人信息修改操作
	 * @return \Controls\Helps\Msg
	 */
	public function setMyInfo() {
		if(!$this->create()){
			$this->msg->status = false;
			$this->msg->content = $this->getError();
		}else{
			$this->id = session('admin')['id'];
			$result = $this->save();
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


}