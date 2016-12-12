<?php
namespace Blog\Controller;

use Admin\Model\ConfigModel;
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
        $article = $articleModel->getHomeDetail($select)->data;
        if(!empty($article)) {

            //文章详情的标题等信息
            $pageInfo = $this->pageInfo;
            $pageInfo['title'] = $article['title'] . '--' . ConfigModel::getDataByName('site_name');
            if(!empty($article['tags'])) {
                $pageInfo['keywords'] = $article['tags'];
            }
            if(!empty($article['summary'])) {
                $pageInfo['description'] = $article['summary'];
            }
            $this->assign('pageInfo',$pageInfo);

            $this->assign('article', $article);
            $this->display('index');
        } else {
            $this->noFund();
        }
    }
}