<?php
namespace Admin\Model\Form\User;

use Admin\Model\UserModel;

/**
 * Class ChangePasswordForm
 * @package Admin\Model\Form\User
 *
 * @property string $oldPass
 * @property string $newPass
 * @property string $againPass
 */
class ChangePasswordForm extends UserModel
{
	protected $_validate = array(
		array('oldPass', 'require', '旧密码不可为空！'), //默认情况下用正则进行验证
		array('newPass', 'require', '新密码不可为空！'), //默认情况下用正则进行验证
		array('againPass', 'require', '确认密码不可为空！'), //默认情况下用正则进行验证
		array('againPass', 'newPass', '确认密码不正确 ', 0, 'confirm'), //默认情况下用正则进行验证
	);

	/**
	 * 个人信息修改操作
	 * @return \Controls\Helps\Msg
	 */
	public function setMyInfo() {
		if(!$this->create()){
			$this->msg->status = false;
			$this->msg->content = $this->getError();
		} else{
			$this->id = session('admin')['id'];
			$data = $this->modelGetDataById($this->id);
			$pass = md5(md5(md5($this->oldPass)));
			if (!empty($data) && $data['password'] == $pass) {
				$data = array(
					'password' => md5(md5(md5($this->newPass))),
				);
				$this->password = md5(md5(md5($this->newPass)));
				$result = $this->save();
				if ($result === false) {
					$this->msg->status = false;
					$this->msg->content = '保存失败！';
				} else {
					$this->msg->status = true;
					$this->msg->content = '保存成功';
				}
			} else {
				$this->msg->status = false;
				$this->msg->content = '原始密码不正确！';
			}
		}
		return $this->msg;
	}


}