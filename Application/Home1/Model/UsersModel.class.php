<?php
namespace Home\Model;

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
 *
 */
class UsersModel extends Model
{
    const NORMAL = 1;            //正常状态
    const BLACK = 2;             //黑名单
    protected $tableName = 'user';

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
    public function checkRouter()
    {
        $allowActions = C('param')['allowActions'];
        $url = '/' . MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
        $this->msg->status = false;
        foreach ($allowActions as $k => $v) {
            if (strcasecmp($v, $url) == 0) {
                $this->msg->status = true;
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
     * @param string $username
     * @param string $password
     * @param string $ip
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
     * @param array $data
     * @param string $ip
     */
    private function saveLoginMsg($data, $ip)
    {
        //保存登录者的用户信息
        session(array('name' => 'session_id', 'expire' => 7200));
        session('user', $data);
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
        $result = session('user');
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
        session('user', null);
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
        $admin = session('user');
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
        $admin = session('user');
        return empty($admin['id']) ? 0 : $admin['id'];
    }

}