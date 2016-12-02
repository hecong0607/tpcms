<?php
namespace Home\Controller;

use Article\Model\ArticleSecModel;
use Think\Controller;

class IndexController extends Controller
{

    public function IndexAction()
    {
        echo 'wait';die;
        $sectionModel = new ArticleSecModel();
        $section = clone $sectionModel->getDataAll();
        $this->assign('section', $section->data);
        $this->display('index');
    }
}