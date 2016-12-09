<?php
namespace Blog\Model;

use Common\Controls\Model;

/**
 * Class ArticleSecModel
 * @package Blog\Model
 * @property integer $id
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $title as $name
 * @property string $content
 * @property string $face
 * @property string $thumb
 * @property integer $status
 * @property integer $type
 * @property integer $list_order
 * @property integer $create_time
 * @property integer $update_time
 */
class ArticleSecModel extends Model
{
    protected $tableName = 'article_section';
    const Enabled = 1;
    const Disable = 0;

    const Article = 0;
    const Face = 1;

    //栏目固定id
    const BlogId = 3;           //博客栏目
    const HomeRight = 9;        //主页右侧栏目
    const HomeLinks = 10;       //友链栏目
    const PhotoId = 11;       //图赏栏目
    const Ambition = 12;       //图赏栏目

    /**
     * 博客页面获取栏目数据
     * @return \Common\Controls\Msg
     */
    public function getSectionByBlog()
    {
        $where = array(
            'status'    => self::Enabled,
            'id' => self::BlogId,
        );
        $data = $this->where($where)->field(array('content'), true)->order('list_order')->find();
        //获取栏目下的子栏目数据
        $tempData = $this->getSectionByParent($data['id']);
        $data['childList'] = $tempData;
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 获取分类数据
     * @param $parent_id
     * @return mixed
     */
    private function getSectionByParent($parent_id)
    {
        $where = array(
            'status'    => self::Enabled,
            'parent_id' => (int)$parent_id,
        );
        $data = $this->where($where)->field(array('content'), true)->order('list_order')->select();
        $articleModel = new ArticleModel();
        foreach ($data as $k => &$v) {
//            if ($v['name']=='最新') {
//                $tempData = clone $articleModel->getDataByNew();
//                $v['articleList'] = $tempData->data;
//            } else {
                $tempData = clone $articleModel->getDataBySectionId($v['id']);
                $v['articleList'] = $tempData->data;
//            }
        }
        return $data;
    }

    /**
     * 获取博客下的栏目的id
     * @return string
     */
    public function getBlogSecIds()
    {
        $where = array(
            'status'    => self::Enabled,
            'parent_id' => self::BlogId,
        );
        $data = $this->where($where)->field(array('content'), true)->order('list_order')->select();
        $result = array();
        foreach($data as $k=>$v){
            $result[] = $v['id'];
        }
        $data = implode(',', $result);
        return $data;
    }

    /**
     * 是否博客栏目，根据id
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function isBlogSec($id)
    {
        $where = array(
            'id' => (int)$id,
            'status' => self::Enabled,
            'parent_id' => self::BlogId,
        );
        $data = $this->where($where)->find();
        if (empty($data)) {
            $this->msg->status = false;
            $this->msg->content = '栏目不存在！';
        } else {
            $this->msg->status = true;
            $this->msg->data = $data;
        }
        return $this->msg;
    }

    /**
     * 获取博客下的栏目信息
     * @return \Common\Controls\Msg
     */
    public function getBlogSec()
    {
        $where = array(
            'status'    => self::Enabled,
            'parent_id' => self::BlogId,
        );
        $data = $this->where($where)->field(array('content'), true)->order('list_order')->select();
        $this->msg->data = $data;
        return $this->msg;
    }

}