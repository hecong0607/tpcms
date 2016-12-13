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
            //阅读量+1，当前设置cookie，2分钟
            $cookieName = md5($article['id']);
            $cookie = $_COOKIE[$cookieName];
            if(empty($cookie)){
                $value = md5('value');
                setcookie($cookieName,$value, time()+ArticleModel::ViewTime*60);
                $articleModel->viewAdd($article['id']);
            }

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