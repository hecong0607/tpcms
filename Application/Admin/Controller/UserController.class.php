<?php
namespace Admin\Controller;

use Admin\Model\Form\User\AdminSave;
use Admin\Model\Form\User\ChangePasswordForm;
use Admin\Model\Form\User\InfoForm;
use Admin\Model\RoleModel;
use Admin\Model\UserModel;

/**
 * 管理员用户类
 * Class UserController
 * @package Admin\Controller
 */
class UserController extends Base
{

    /**
     * 新增页面
     */
    public function addAction()
    {
        $this->save();
    }

    /**
     * 添加数据接口
     */
    public function doAddAction()
    {
        $this->doSave();
    }

    /**
     * 修改页面
     */
    public function saveAction()
    {
        $id = I('get.id', 0);
        $this->save($id);
    }

    /**
     * 修改数据接口
     */
    public function doSaveAction()
    {
        $id = I('post.id');
        $this->doSave($id);
    }

    /**
     * 列表页面
     */
    public function listAction()
    {
        $userModel = new UserModel();
        $msgUser = $userModel->getList();
        $this->assign(array('list' => $msgUser->data['list'], 'page' => $msgUser->data['page']));
        $this->display('User/list');
    }

    /**
     * 删除数据接口
     */
    public function delAction()
    {
        $id = I('get.id');
        $userModel = new UserModel();
        $msgDel = $userModel->del($id);
        if ($msgDel->status == false) {
            $this->error($msgDel->content);
        } else {
            $this->success($msgDel->content);
        }
    }

    /**
     * 修改和保存操作封装
     * @param string $id
     */
    protected function doSave($id = '')
    {
        if (IS_POST) {
            $userModel = new AdminSave();
            $userModel->id = $id;
            $userModel->username = I('post.username');
            $userModel->password = I('post.password');
            $userModel->phone = I('post.phone');
            $userModel->email = I('post.email');
            $userModel->role = I('post.role');
            $msgSave = $userModel->doSave();
            if ($msgSave->status == false) {
                $this->error($msgSave->content);
            } else {
                $this->success($msgSave->content, U('Admin/User/list'));
            }
        } else {
            $this->error('保存失败！', U('Admin/User/save'));
        }
    }

    /**
     * 修改和保存页面封装
     * @param string $id
     */
    protected function save($id = '')
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();
        $roleData = $roleModel->getRoleAllForSelect();
        $msgData = $userModel->getData($id);
        $this->assign('data', $msgData->data);
        $this->assign('roleData', $roleData->data);
        $this->display('User/save');
    }

    /**
     * 拉黑
     */
    public function setBlackAction()
    {
        $id = I('get.id');
        $userModel = new UserModel();
        $msgBlack = $userModel->setBlack($id);
        if ($msgBlack->status == true) {
            $this->success($msgBlack->content, U('Admin/User/list'));
        } else {
            $this->error($msgBlack->content, U('Admin/User/list'));
        }
    }

    /**
     * 启用
     */
    public function setEnableAction()
    {
        $id = I('get.id');
        $userModel = new UserModel();
        $msgBlack = $userModel->setEnable($id);
        if ($msgBlack->status == true) {
            $this->success($msgBlack->content, U('Admin/User/list'));
        } else {
            $this->error($msgBlack->content, U('Admin/User/list'));
        }
    }


    /*****************************
     *    用户修改
     ****************************/
    /**
     * 登录者信息修改页面
     */
    public function infoAction()
    {
        $userModel = new InfoForm();
        $infoMsg = $userModel->getMyData();
        $this->assign('data', $infoMsg->data);
        $this->display('User/info');
    }

    /**
     * 密码修改页面
     */
    public function passAction()
    {
        $this->display('User/pass');
    }

    /**
     * 信息修改--操作
     */
    public function setInfoAction()
    {
        $userModel = new InfoForm();
        $userModel->realname = I('post.realname');
        $userModel->phone = I('post.phone');
        $userModel->email = I('post.email');
        $userModel->qq = I('post.qq');
        $userMsg = $userModel->setMyInfo();
        if ($userMsg->status) {
            $this->success($userMsg->content);
        } else {
            $this->error($userMsg->content);
        }


    }

    /**
     * 密码修改--操作
     */
    public function setPassAction()
    {
        $userModel = new ChangePasswordForm();
        $userModel->oldPass = I('post.oldPass');
        $userModel->password = I('post.password');
        $userModel->againPass = I('post.againPass');
        $userMsg = $userModel->setMyPass();
        if ($userMsg->status) {
            $this->success($userMsg->content);
        } else {
            $this->error($userMsg->content);
        }
    }


}