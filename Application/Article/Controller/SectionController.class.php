<?php
namespace Article\Controller;

use Admin\Controller\Base;
use Article\Model\ArticleSecModel;

class SectionController extends Base
{


    /**
     * 普通人员应用
     */


    //栏目列表
    public function listAction()
    {
        $sectionModel = new ArticleSecModel();
        $msgData = $sectionModel->getList();
        $this->assign(array('list' => $msgData->data, 'admin' => 0));
        $this->display('Section/list');
    }


    /**
     * 管理人员应用
     */

    //栏目列表
    public function listAdminAction()
    {
        $sectionModel = new ArticleSecModel();
        $msgData = $sectionModel->getList();
        $this->assign(array('list' => $msgData->data, 'admin' => 1));
        $this->display('Section/list');
    }

    /**
     * 获取筛选条件
     * @return array
     */
    protected function getSelect()
    {
        $select = array(
            'name'=>I('get.name',''),
        );
        return $select;
    }

    /**
     * 栏目新增页面
     */
    public function addAction()
    {
        $this->save();
    }

    /**
     * 栏目新增操作
     */
    public function doAddAction()
    {
        $uid = $this->getMyInfo()['id'];
        $this->doSave($uid);
    }

    /**
     * 栏目编辑页面
     */
    public function saveAction()
    {
        $id = I('get.id', 0);
        $this->save($id);
    }

    /**
     * 栏目编辑操作
     */
    public function doSaveAction()
    {
        $id = I('post.id', 0);
        $uid = $this->getMyInfo()['id'];
        $this->doSave($uid, $id);
    }

    //栏目详情页面
    public function showAction()
    {
        $sectionModel = new ArticleSecModel();
        $id = I('get.id', 0);
        $msgData = $sectionModel->getDataByIdSave($id);
        $this->assign('data', $msgData->data);
        $this->assign('admin', 0);
        $this->display('Section/show');
    }
    //栏目详情页面--管理员
    public function showAdminAction()
    {
        $sectionModel = new ArticleSecModel();
        $id = I('get.id', 0);
        $msgData = $sectionModel->getDataByIdSave($id);
        $this->assign('data', $msgData->data);
        $this->assign('admin', 1);
        $this->display('Section/show');
    }

    //栏目删除
    public function delAction()
    {
        $id = I('get.id');
        $sectionModel = new ArticleSecModel();
        $uid = $this->getMyInfo()['id'];
        $msgDel = $sectionModel->del($uid, $id);
        if ($msgDel->status == false) {
            $this->error($msgDel->content);
        } else {
            $this->success($msgDel->content);
        }
    }

    /**
     * 接收页面传递数据
     * @param ArticleSecModel $sectionModel
     */
    protected function postData(ArticleSecModel &$sectionModel)
    {
        $sectionModel->title = I('post.title', '');
        $sectionModel->list_order = (int)I('post.list_order', '');
        $sectionModel->parent_id = (int)I('post.parent_id', '');
        $sectionModel->content = I('post.content', '');
        $sectionModel->face = I('post.face', '');
        $sectionModel->thumb = I('post.thumb', '');
        $sectionModel->status = (int)I('post.status', 0);
        $sectionModel->type = (int)I('post.type', 0);
    }

    /**
     * 修改和保存操作封装
     * @param string $uid
     * @param string $id
     */
    protected function doSave($uid = '', $id = '')
    {
        if (IS_POST) {

            $sectionModel = new ArticleSecModel();
            $sectionModel->id = $id;
            $sectionModel->user_id = $uid;
            $this->postData($sectionModel);
            $msgSave = $sectionModel->doSave();
            if ($msgSave->status == false) {
                $this->error($msgSave->content);
            } else {
                $this->success($msgSave->content, U('Article/Section/listAdmin'));
            }
        } else {
            $this->error('保存失败！', U('Article/Section/save'));
        }
    }

    /**
     * 修改和保存页面封装
     * @param string $id
     */
    protected function save($id = '')
    {
        $sectionModel = new ArticleSecModel();
        //本栏目数据
        $msgData = clone $sectionModel->getDataByIdSave($id);
        $this->assign('data', $msgData->data);
        //栏目所有数据
        $msgSections = clone $sectionModel->getSectionAll($msgData->data['id']);
//        var_dump($msgSections->data);die;
        $this->assign('sections', $msgSections->data);
        $this->display('/Section/save');
    }
}