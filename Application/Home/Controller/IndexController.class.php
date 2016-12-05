<?php
namespace Home\Controller;

use Article\Model\ArticleModel;
use Article\Model\ArticleSecModel;
use Think\Controller;

class IndexController extends Controller
{

    public function IndexAction()
    {
        echo 'wait';die;
        $sectionModel = new ArticleSecModel();
        $section = $sectionModel->getDataAll()->data;
        $this->assign('section', $section);

        $articleModel = new ArticleModel();
        $pageConfig = array('url' => '/' );
        $select = array();
        $articles = $articleModel->getHomeData($select, $pageConfig)->data;
        $this->assign('articles', $articles);

        $this->display('index');
    }
}