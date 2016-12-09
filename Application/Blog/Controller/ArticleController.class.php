<?php
namespace Blog\Controller;

use Blog\Model\ArticleModel;

class ArticleController extends Base
{
    public function indexAction()
    {

        //获取文章详情
        $articleModel = new ArticleModel();
        $select = array(
            'articleId' => (int)I('get.id'),
        );
        U();
        $article = $articleModel->getHomeDetail($select)->data;
        if(!empty($article)) {
            $this->assign('article', $article);
            $this->display('index');
        } else {
            $this->noFund();
        }
    }
}