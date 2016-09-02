<?php
namespace Admin\Model;

use Common\Controls\Model;

/**
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
 *
 */
class UserModel extends Model
{
    const NORMAL = 1;            //正常状态
    const BLACK = 2;             //黑名单
    protected $tableName = 'admin_user';

    const TIME_LOGIN = 7200;

    /********************************************
     *********************************************
     *          用户操作
     ********************************************
     ********************************************/

    /**
     * 可能需要移除，移至base中
     * 当前是否是不需要验证的
     * @return \Common\Controls\Msg
     */
    public function checkRouter($url)
    {
        $allowActions = C('param')['allowActions'];
        $this->msg->status = false;
        foreach ($allowActions as $k => $v) {
            if (strcasecmp($v, $url) == 0) {
                $this->msg->status = true;
                layout(false);
                break;
            }
        }
        return $this->msg;
    }

    /**
     * 通过用户名获取用户信息
     * @param $username
     * @return mixed
     */
    protected function modelGetUserByName($username)
    {
        $where = [
            'username' => $username,
            'status'   => self::NORMAL,
        ];
        $data = $this->where($where)->find();
        return $data;
    }

    /**
     * 登录操作
     * @param $username
     * @param $password
     * @param $ip
     * @return \Common\Controls\Msg
     */
    public function doLogin($username, $password, $ip)
    {
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
    private function saveLoginMsg($data, $ip)
    {
        //保存登录者的用户信息
        session(array('name' => 'session_id', 'expire' => 7200));
        session('admin', $data);
        //获取并保存登录者的权限信息
        $roleModel = new RoleModel();
        $msgRole = $roleModel->getDataById($data['role']);
        session('role', $msgRole->data);
        //修改登录次数、时间和ip
        $updateData = array(
            'last_time'   => time(),
            'last_ip'     => $ip,
            'login_count' => (int)$data['login_count'] + 1,
        );
        $this->id = $data['id'];
        $this->save($updateData);
    }

    /**
     * 验证当前是否登录
     * @return \Common\Controls\Msg
     */
    public function checkIsLogin()
    {
        $result = session('admin');
        if (empty($result)) {
            $this->msg->status = false;
        } else {
            $this->msg->status = true;
        }
        return $this->msg;
    }

    /**
     * 退出登录的信息删除操作
     */
    public function logout()
    {
        session('admin', null);
        session('role', null);
        $this->msg->status = true;
        $this->msg->content = '退出成功！';
        return $this->msg;
    }

    /**
     * 获取登录者的信息
     * @return \Common\Controls\Msg
     */
    public function getMyData()
    {
        $admin = session('admin');
        $this->id = (int)$admin['id'];
        $this->msg->data = $this->find();
        $this->msg->status = empty($this->msg->data) ? false : true;
        return $this->msg;
    }

    /**
     * 获取登录者id
     * @return int
     */
    protected function getMyId()
    {
        $admin = session('admin');
        return empty($admin['id']) ? 0 : $admin['id'];
    }

    /********************************************
     *********************************************
     *         管理员操作
     ********************************************
     ********************************************/

    /**
     * 获取数据，并分页，返回数据
     * @return \Common\Controls\Msg
     */
    public function getList()
    {
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
     * @return \Common\Controls\Msg
     */
    public function getData($id)
    {
        $this->msg->data = $this->where(array('id' => $id))->find();
        $this->msg->status = empty($this->msg->data) ? false : true;
        return $this->msg;
    }


    /**
     * 拉黑
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function setBlack($id)
    {
        $this->id = $id;
        $this->status = self::BLACK;
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
     * @return \Common\Controls\Msg
     */
    public function setEnable($id)
    {
        $this->id = $id;
        $this->status = self::NORMAL;
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
     * 删除数据逻辑，返回删除结果
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function del($id)
    {
        if ($id == 1) {
            $result = false;
        } else {
            $result = $this->delete((int)$id);
        }
        if ($result == false) {
            $this->msg->status = false;
            $this->msg->content = '删除失败！';
        } else {
            $this->msg->status = true;
            $this->msg->content = '删除成功！';
        }
        return $this->msg;
    }

}