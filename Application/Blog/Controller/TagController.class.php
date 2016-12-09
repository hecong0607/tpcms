<?php
namespace Blog\Controller;

use Blog\Model\ArticleModel;

class TagController extends Base
{
    public function indexAction()
    {
        //获取以图明志数据
        $articleModel = new ArticleModel();
        $msgAmb = clone $articleModel->getAmbition();
        $this->assign('ambition', $msgAmb->data);

        $tag_name = I('get.tags');
        $articleModel = new ArticleModel();
        $pageConfig = array('url' => 'Tag/' . $tag_name );
        $select = array(
            'tag_name' => $tag_name,
        );
        $articles = $articleModel->getHomeData($select, $pageConfig)->data;
        if (!empty($articles['list'])) {
            $this->assign('articles', $articles);
            $this->display('index');
        } else {
            $this->noFund();
        }
    }
}