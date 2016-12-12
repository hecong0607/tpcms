<?php
namespace Home\Controller;

use Article\Model\ArticleModel;
use Article\Model\ArticleSecModel;

class SectionController extends Base
{
    public function indexAction()
    {
        $id = (int)I('get.id');
        //栏目
        $sectionModel = new ArticleSecModel();
        $section = clone $sectionModel->getHomeDataById($id);
        if($section->status == true) {
            $this->assign('section', $section->data);

            //栏目文章
            $articleMode = new ArticleModel();
            $pageConfig = array('url' => 'Section/' . $id);
            $select = array('section_id' => $id);
            $article = clone $articleMode->getHomeData($select, $pageConfig);
            $this->assign('article', $article->data);
            $this->display('index');
        } else {
            $this->display('empty');
        }
    }
}