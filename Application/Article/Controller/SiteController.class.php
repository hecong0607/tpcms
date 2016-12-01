<?php
namespace Article\Controller;

use Admin\Controller\Base;
use Article\Model\ArticleModel;
use Article\Model\ArticleSecModel;

/**
 * 文章控制器
 * Class SiteController
 * @package Admin\Controller
 */
class SiteController extends Base
{

    //文章添加页面
    public function addAction()
    {
        $uid = $this->getMyInfo()['id'];
        $this->save($uid);
    }

    //文章添加操作
    public function doAddAction()
    {
        $uid = $this->getMyInfo()['id'];
        $this->doSave($uid);
    }

    //文章修改页面
    public function saveAction()
    {
        $id = I('get.id', 0);
        $uid = $this->getMyInfo()['id'];
        $this->save($uid, $id);
    }

    //文章修改操作
    public function doSaveAction()
    {
        $id = I('post.id', 0);
        $uid = $this->getMyInfo()['id'];
        $this->doSave($uid, $id);
    }

    //文章列表
    public function listAction()
    {
        $articleModel = new ArticleModel();
        $uid = $this->getMyInfo()['id'];
        $select = $this->getSelect();
        $msgData = $articleModel->getList($uid, $select);
        $this->assign(array('list' => $msgData->data['list'], 'page' => $msgData->data['page']));
        $this->display('Site/list');
    }

    //文章删除
    public function delAction()
    {
        $id = I('get.id', 0);
        $articleModel = new ArticleModel();
        $uid = $this->getMyInfo()['id'];
        $msgDel = $articleModel->del($uid, $id);
        if ($msgDel->status == false) {
            $this->error($msgDel->content);
        } else {
            $this->success($msgDel->content);
        }
    }

    /**
     * 发布和下架文章
     */
    public function releaseAction()
    {
        $id = I('get.id', 0);
        $uid = $this->getMyInfo()['id'];
        $articleModel = new ArticleModel();
        $msgDel = $articleModel->setStatus($id, $uid);
        if ($msgDel->status == false) {
            $this->error($msgDel->content);
        } else {
            $this->success($msgDel->content);
        }
    }

    /**
     * 接收页面传递数据
     * @param ArticleModel $articleModel
     */
    protected function postData(ArticleModel &$articleModel)
    {
        $articleModel->title = I('post.title', '');
        $articleModel->section_id = I('post.section_id', 0);
        $articleModel->tags = I('post.tags', '');
        $articleModel->content = I('post.content', '');
        $articleModel->summary = I('post.summary', '');
        $articleModel->face = I('post.face', '');
        $articleModel->status = I('post.status', '');
    }

    /**
     * 修改和保存操作封装
     * @param int $uid
     * @param int $id
     */
    protected function doSave($uid = 0, $id = 0)
    {
        if (IS_POST) {
            $articleModel = new ArticleModel();
            $articleModel->id = $id;
            $articleModel->user_id = $uid;
            $this->postData($articleModel);
            $sectionModel = new ArticleSecModel();
            $msgData = clone $sectionModel->getDataById($id);
            if ($msgData->status == false) {
                $articleModel->section_id = 0;
            }
            $msgSave = clone $articleModel->doSave();
            if ($msgSave->status == false) {
                $this->error($msgSave->content);
            } else {
                $this->success($msgSave->content, U('Article/Site/list'));
            }
        } else {
            $this->error('保存失败！', U('Article/Site/save'));
        }
    }

    /**
     * 修改和保存页面封装
     * @param int $uid
     * @param int $id
     */
    protected function save($uid = 0, $id = 0)
    {
        $articleModel = new ArticleModel();
        $msgData = $articleModel->getDataById($id, $uid);
        $data = $msgData->data;
        $section = new ArticleSecModel();
        $secData = clone $section->getDataAll();
        $data['section'] = $secData->data;
        $this->assign('data', $data);
        $this->display('/Site/save');
    }

    /***
     * 管理员操作
     */

    /**
     * 文章列表
     */
    public function listAdminAction()
    {
        $articleModel = new ArticleModel();
        $select = $this->getSelect();
        $msgData = $articleModel->getLisBytAdmin($select);
        $this->assign(array('list' => $msgData->data['list'], 'page' => $msgData->data['page']));
        $this->display('Site/listadmin');
    }

    /**
     * 文章审核设置
     */
    public function setPendAction()
    {
        $id = I('get.id', 0);
        $flag = I('get.flag', 0);
        $articleModel = new ArticleModel();
        $msgDel = $articleModel->setPendAdmin($id, $flag);
        if ($msgDel->status == false) {
            $this->error($msgDel->content);
        } else {
            $this->success($msgDel->content);
        }
    }

    /**
     * 获取筛选条件
     * @return array
     */
    protected function getSelect()
    {
        $select = array(
            'title'      => I('get.title', ''),
            'editor'     => I('get.editor', ''),
            'start_time' => strtotime(I('get.start_time', '')),
            'end_time'   => strtotime(I('get.end_time', '')),
        );
        return $select;
    }

}