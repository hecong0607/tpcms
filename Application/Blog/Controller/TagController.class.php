<?php
namespace Blog\Controller;

use Admin\Model\ConfigModel;
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
        //标题文章信息
        $articles = $articleModel->getHomeData($select, $pageConfig)->data;
        if (!empty($articles['list'])) {
            //标题的页面标题等信息
            $pageInfo = $this->pageInfo;
            $pageNum = empty($_GET['p'])? 1:$_GET['p'];
            $pageInfo['title'] = $tag_name . ' - 第' . $pageNum .  '页 --' . ConfigModel::getDataByName('site_name');
            $this->assign('pageInfo',$pageInfo);

            $this->assign('articles', $articles);
            $this->display('index');
        } else {
            $this->noFund();
        }
    }
}