<?php
namespace Blog\Controller;

use Admin\Model\ConfigModel;
use Blog\Model\ArticleModel;
use Blog\Model\ArticleSecModel;

class IndexController extends Base
{
    public function __construct()
    {
        parent::__construct();
        $pageInfo = $this->pageInfo;
        $pageInfo['title'] = '博客频道——' . ConfigModel::getDataByName('site_name');
        $this->assign('pageInfo',$pageInfo);
    }

    public function indexAction()
    {
        //获取博客数据
        $sectionModel = new ArticleSecModel();
        $msgBlog = clone $sectionModel->getSectionByBlog();
        $this->assign('blog', $msgBlog->data);

        //获取动态数据--图赏
        $articleModel = new ArticleModel();
        $msgPhoto = clone $articleModel->getDataByPhoto();
        $this->assign('photo', $msgPhoto->data);
        //获取动态数据--最新
        $msgNew = clone $articleModel->getDataByNew();
        $this->assign('new', $msgNew->data);


        $this->display('index');
    }
}