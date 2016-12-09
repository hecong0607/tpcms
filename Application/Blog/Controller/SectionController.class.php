<?php
namespace Blog\Controller;

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