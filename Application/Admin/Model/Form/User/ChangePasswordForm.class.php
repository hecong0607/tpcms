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
//	public $oldPass;
//	public $password;
//	public $againPass;

	protected $_validate = array(
		array('oldPass', 'require', '原始密码不可为空！', 1),
		array('password', 'require', '新密码不可为空！', 1),
		array('againPass', 'require', '确认密码不可为空！', 1),
		array('againPass', 'password', '确认密码不正确 ', 1, 'confirm'),
		array('oldPass', 'confirmOldPass', '原始密码不正确 ', 1, 'callback'),
	);

	/**
	 * 个人信息修改操作
	 * @return \Common\Controls\Msg
	 */
	public function setMyPass() {
		if (!$this->create($this->data)) {
			$this->msg->status = false;
			$this->msg->content = $this->getError();
		} else {
			$this->password = md5(md5(md5($this->password)));
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

	protected function confirmOldPass($oldPass) {
		$this->id = session('admin')['id'];
		$data = $this->find();
		$pass = md5(md5(md5($oldPass)));
		if (!empty($data) && $data['password'] == $pass) {
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}


}