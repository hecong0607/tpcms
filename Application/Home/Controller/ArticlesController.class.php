<?php
namespace Home\Controller;
use Article\Model\ArticleModel;
use Article\Model\ArticleSecModel;

/**
 * Class ArticlesController
 * @package Home\Controller
 */
class ArticlesController extends Base
{

    public function allAction()
    {
        //文章数据
        $articleModel = new ArticleModel();
        $pageConfig = array('url' => 'Articles/all' );
        $select = array();
        $articles = $articleModel->getHomeData($select, $pageConfig)->data;
        $this->assign('articles', $articles);
        $this->display('all');
    }

    public function detailAction()
    {
         //文章数据
        $articleModel = new ArticleModel();
        $select = array(
            'articleId' => (int)I('get.id'),
        );
        $article = $articleModel->getHomeDetail($select)->data;
        $this->assign('article', $article);
        $this->display('detail');
    }
}