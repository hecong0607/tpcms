<?php
namespace Article\Controller;

use Admin\Controller\Base;
use Article\Model\ArticleTagsModel;

class TagsController extends Base
{

    //标签查看
    public function listAction()
    {
        $tagsModel = new ArticleTagsModel();
        $select = $this->getSelect();
        $msgData = $tagsModel->getList($select);
        $this->assign(array('list' => $msgData->data['list'], 'page' => $msgData->data['page']));
        $this->display('Tags/list');
    }

    /**
     * 获取筛选条件
     * @return array
     */
    protected function getSelect()
    {
        $select = array(
            'name'=>I('get.name',''),
        );
        return $select;
    }

}