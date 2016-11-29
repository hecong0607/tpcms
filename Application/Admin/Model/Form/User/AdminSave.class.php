<?php
namespace Admin\Model\Form\User;

use Admin\Model\UserModel;

class AdminSave extends UserModel
{

	/**
	 * 保存操作（新增和修改）
	 * @return \Common\Controls\Msg
	 */
	public function doSave() {
		$this->checkSave();
		if ($this->msg->status == true) {
			$data = array(
				'username' => $this->username,
				'phone'    => $this->phone,
				'email'    => $this->email,
				'role'     => $this->role,
			);
			if (!empty($this->password)) {
				$data['password'] = md5(md5(md5($this->password)));
			}
			if (empty($this->id)) {
				$result = $this->add($data);
			} else {
				$result = $this->where(array('id' => $this->id))->save($data);
			}
			if ($result === false) {
				$this->msg->status = false;
				$this->msg->content = $this->getLastSql();
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
		if (empty($this->username)) {
			$this->msg->status = false;
			$this->msg->content = '用户名不可为空！';
			return;
		}
		if (empty($this->role)) {
			$this->msg->status = false;
			$this->msg->content = '角色不可以为空！';
			return;
		}
		if (empty($this->id) ) {       //新增
            if(empty($this->password)) {
                $this->msg->status = false;
                $this->msg->content = '密码不可为空！';
                return;
            }
            $find = $this->where(array('username'=>$this->username))->find();
            if( !empty($find)){
                $this->msg->status = false;
                $this->msg->content = '用户名重复！';
                return;
            }
		} else {    //修改

        }

	}
}