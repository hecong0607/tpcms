<?php
namespace Admin\Model;

use Common\Controls\Model;

/**
 * 管理员用户类
 * Class UserModel
 * @package Admin\Model
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $realname
 * @property string $phone
 * @property string $email
 * @property string $qq
 * @property string $last_ip
 * @property integer $last_time
 * @property integer $login_count
 * @property integer $status
 * @property integer $role
 */
class UserModel extends Model
{
	const normal = 1;            //正常状态
	const black = 2;             //黑名单
	protected $tableName = 'admin_user';

	protected $_validate = array(

	);

	/**************************
	 *        增
	 **************************/

	/**************************
	 *        删
	 **************************/

	/**************************
	 *        改
	 **************************/

	/**************************
	 *        查
	 **************************/

	/**
	 * 通过用户名获取用户信息
	 * @param $username
	 * @return mixed
	 */
	private function modelGetUserByName($username) {
		$where = [
			'username' => $username,
			'status'   => self::normal,
		];
		$data = $this->where($where)->find();
		return $data;
	}


	/********************************************
	 *********************************************
	 *         逻辑数据处理
	 ********************************************
	 ********************************************/

	//不需要验证的路由,check=true不需要验证
	private $Router = array(
		array('module' => 'Admin', 'controller' => 'Public', 'action' => 'login', 'check' => true),
		array('module' => 'Admin', 'controller' => 'Public', 'action' => 'dologin', 'check' => true),
		array('module' => 'Admin', 'controller' => 'Public', 'action' => 'verify', 'check' => true),
		array('module' => 'Admin', 'controller' => 'Home', 'action' => 'index', 'check' => false),
	);

	const timeLogin = 7200;

	/**
	 * 验证当前是否登录
	 * @return \Controls\Helps\Msg
	 */
	public function checkIsLogin() {
		$result = session('admin');
		if (empty($result)) {
			$this->msg->status = false;
		} else {
			$this->msg->status = true;
		}
		return $this->msg;
	}

	/**
	 * 当前是否是不需要验证的
	 * @return \Controls\Helps\Msg
	 */
	public function checkRouter() {
		$this->msg->status = false;
		foreach ($this->Router as $k => $v) {
			if (MODULE_NAME == $v['module'] && CONTROLLER_NAME == $v['controller'] && ACTION_NAME == $v['action']) {
				if ($v['check'] == true) {
					$this->msg->status = true;
				}
				layout(false);
				break;
			}
		}
		return $this->msg;
	}

	/**
	 * 登录操作
	 * @param $username
	 * @param $password
	 * @param $ip
	 * @return \Controls\Helps\Msg
	 */
	public function doLogin($username, $password, $ip) {
		$data = $this->modelGetUserByName($username);
		$pass = md5(md5(md5($password)));
		if (!empty($data) && $data['password'] == $pass) {
			$this->msg->status = true;
			$this->msg->data = $data;
			$this->msg->content = '登录成功！';
			$this->saveLoginMsg($data, $ip);
		} else {
			$this->msg->status = false;
			$this->msg->content = '帐号或密码错误！';
		}
		return $this->msg;
	}

	/**
	 * 登录操作成功后的保存和更新数据操作
	 * @param $data
	 * @param $ip
	 */
	private function saveLoginMsg($data, $ip) {
		//保存登录者的用户信息
		session(array('name' => 'session_id', 'expire' => 7200));
		session('admin', $data);
		//获取并保存登录者的权限信息
		$roleModel = new AdminRoleModel();
		$msgRole = $roleModel->getDataById($data['role']);
		session('role', $msgRole->data);
		//修改登录次数、时间和ip
		$updateData = array(
			'last_time'   => time(),
			'last_ip'     => $ip,
			'login_count' => (int)$data['login_count'] + 1,
		);
		$this->id = $data['id'];
		$this->modelDoSave($updateData);
	}

	/**
	 * 退出登录的信息删除操作
	 */
	public function logout() {
		session('admin', null);
		session('role', null);
	}

	/**
	 * 获取数据，并分页，返回数据
	 * @return \Controls\Helps\Msg
	 */
	public function getList() {
		$count = (int)$this->count();
		$db_prefix = C('DB_PREFIX');
		$Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
		$list = $this->join(' left join ' . $db_prefix . 'admin_role on ' . $db_prefix . 'admin_user.role = ' . $db_prefix . 'admin_role.id')->field($db_prefix . 'admin_user.*,' . $db_prefix . 'admin_role.name ')->order($db_prefix . 'admin_user.id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
		$data = array(
			'page' => $Page->show(),
			'list' => $list,
		);
		$this->msg->data = $data;
		return $this->msg;
	}

	/**
	 * 根据id获取的一条数据
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function getData($id) {
		$this->msg->data = $this->find($id);
		$this->msg->status = empty($this->msg->data) ? false : true;
		return $this->msg;
	}

	/**
	 * 获取登录者的信息
	 * @return \Controls\Helps\Msg
	 */
	public function getMyData() {
		$admin = session('admin');
		$id = (int)$admin['id'];
		return $this->getData($id);
	}

	/**
	 * 拉黑
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function setBlack($id) {
		$this->id = $id;
		$this->status = self::black;
		$result = $this->save();
		if ($result === false) {
			$this->msg->status = false;
			$this->msg->content = '拉黑失败！';
		} else {
			$this->msg->status = false;
			$this->msg->content = '拉黑成功！';
		}
		return $this->msg;
	}

	/**
	 * 启用
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function setEnable($id) {
		$this->id = $id;
		$this->status = self::normal;
		$result = $this->save();
		if ($result === false) {
			$this->msg->status = false;
			$this->msg->content = '启用失败！';
		} else {
			$this->msg->status = false;
			$this->msg->content = '启用成功！';
		}
		return $this->msg;
	}

	/**
	 * 保存操作（新增和修改）
	 * @return \Controls\Helps\Msg
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
				$result = $this->modelDoAdd($data);
			} else {
				$result = $this->modelDoSave($data);
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
		if (empty($this->id) && empty($this->password)) {
			$this->msg->status = false;
			$this->msg->content = '密码不可为空！';
			return;
		}
	}

	/**
	 * 删除数据逻辑，返回删除结果
	 * @param $id
	 * @return \Controls\Helps\Msg
	 */
	public function del($id) {
		$result = $this->delete((int)$id);
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
	 * 个人信息修改操作
	 * @return \Controls\Helps\Msg
	 */
	public function setMyInfo() {
		if (empty($this->realname)) {
			$this->msg->status = false;
			$this->msg->content = '昵称不可为空！';
		} else {
			$data = array(
				'realname' => $this->realname,
				'phone'    => $this->phone,
				'email'    => $this->email,
				'qq'       => $this->qq,
			);
			$this->id = session('admin')['id'];
			$result = $this->modelDoSave($data);
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
	 * 个人修密码修改
	 * @param $oldPass
	 * @param $newPass
	 * @param $againPass
	 * @return \Controls\Helps\Msg
	 */
	public function setMyPass($oldPass, $newPass, $againPass) {
		if (empty($oldPass)) {
			$this->msg->status = false;
			$this->msg->content = '原始密码不可为空！';
		} elseif (empty($newPass)) {
			$this->msg->status = false;
			$this->msg->content = '新密码不可为空！';
		} elseif (empty($againPass)) {
			$this->msg->status = false;
			$this->msg->content = '重复新密码不可为空！';
		} elseif ($newPass != $againPass) {
			$this->msg->status = false;
			$this->msg->content = '两次密码不一致！';
		} else {
			$this->id = session('admin')['id'];
			$data = $this->modelGetDataById($this->id);
			$pass = md5(md5(md5($oldPass)));
			if (!empty($data) && $data['password'] == $pass) {
				$data = array(
					'password' => md5(md5(md5($newPass))),
				);
				$result = $this->modelDoSave($data);
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