<?php
namespace Article\Controller;
use Admin\Controller\Base;
/**
 * 文章控制器
 * Class ArticleController
 * @package Admin\Controller
 */
class SiteController extends Base
{
    //文章创建
    public function addAction()
    {

        $this->display('/site/save');
    }
    //文章创建
    public function saveAction()
    {

        $this->display();
    }
    //文章添加
    public function doAddAction()
    {

    }
    //文章保存
    public function doSaveAction()
    {

    }
    //文章列表
    public function listAction()
    {
        $this->display('/site/list');
    }
    //文章删除
    public function delAction()
    {

    }


}