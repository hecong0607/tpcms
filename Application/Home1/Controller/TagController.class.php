<?php
namespace Home\Controller;
use Article\Model\ArticleModel;

class TagController extends Base
{
   public function indexAction()
   {
       $tags = I('get.tags');
       $articleModel = new ArticleModel();
       $pageConfig = array('url' => 'Tag/' . $tags );
       $select = array(
           'tags' => $tags,
       );
       $articles = $articleModel->getHomeData($select, $pageConfig)->data;
       $this->assign('articles', $articles);
       $this->display('tags');
   }
}