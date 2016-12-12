<?php
namespace Blog\Controller;

use Admin\Model\ConfigModel;
use Blog\Model\ArticleModel;
use Blog\Model\ArticleSecModel;

class SectionController extends Base
{
    public function indexAction()
    {
        //获取以图明志数据
        $articleModel = new ArticleModel();
        $msgAmb = clone $articleModel->getAmbition();
        $this->assign('ambition', $msgAmb->data);

        //获取栏目数据
        $id = (int)I('get.id');
        //查看是否博客栏目
        $sectionModel = new ArticleSecModel();
        $section = clone $sectionModel->isBlogSec($id);
        if ($section->status == true) {
            $this->assign('section', $section->data);

            //栏目标题等信息
            $pageInfo = $this->pageInfo;
            $pageNum = empty($_GET['p'])? 1:$_GET['p'];
            $pageInfo['title'] = $section->data['name'] . ' - 第' . $pageNum .  '页 --' . ConfigModel::getDataByName('site_name');
            $this->assign('pageInfo',$pageInfo);

            //该栏目下的所有文章
            $articleMode = new ArticleModel();
            $pageConfig = array('url' => '/Blog/Section/' . $id);
            $select = array('section_id' => $id);
            $articles = clone $articleMode->getHomeData($select, $pageConfig);
            $this->assign('articles', $articles->data);
            $this->display('index');
        } else {
            $this->noFund();
        }
    }
}