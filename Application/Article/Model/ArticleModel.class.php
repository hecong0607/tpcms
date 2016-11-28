<?php
namespace Article\Model;

use Common\Controls\Model;

/**
 * Class ArticleModel
 * @package Article\Model
 * @property integer $id
 * @property integer $user_id
 * @property integer $section_id
 * @property string $face
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property integer $view
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class ArticleModel extends Model
{
    protected $tableName = 'article';
    const Enabled = 1;
    const Disable = 0;

    /**
     * 验证保存的数据（新增和修改）
     */
    protected function checkSave()
    {
        $this->msg->status = true;
        if (empty($this->title)) {
            $this->msg->status = false;
            $this->msg->content = '标题不可为空！';
            return;
        }
    }

    public function doSave()
    {
        $this->checkSave();
        if ($this->msg->status == true) {
            $data = array(
                'title'    => $this->title,
                'content' => $this->content,
                'face' => $this->face,
                'tags' => $this->tags,
                'section_id' => $this->section_id,
                'status'  => self::Enabled,
            );
            if (empty($this->id)) {
                $data['create_time'] = time();
                $data['user_id'] = $this->user_id;
                $result = $this->add($data);
            } else {
                $data['update_time'] = time();
                $result = $this->where(array('id' => $this->id,'user_id'=>$this->user_id))->save($data);
            }
            if ($result === false) {
                $this->msg->status = false;
                $this->msg->content = '保存失败！';
            } else {
                $this->msg->status = true;
                $this->msg->content = '保存成功';
            }
        }
        return $this->msg;
    }

    /**
     * 获取数据，并分页，返回数据
     * @param $uid
     * @return \Common\Controls\Msg
     */
    public function getList($uid)
    {
        $where = array('user_id'=>$uid);
        $count = (int)$this->where($where)->count();
        $Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
        $list = $this->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $data = array(
            'page' => $Page->show(),
            'list' => $list,
        );
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 获取数据，根据id或者uid和id
     * @param string $uid
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function getDataById($uid='',$id)
    {
        $where = array();
        $where['id'] = $id;
        $where['status'] = self::Enabled;
        if(!empty($uid)){
            $where['user_id'] = $uid;
        }

        $data = $this->where($where)->find();
        if (empty($data)) {
            $this->msg->status = false;
            $this->msg->content = '文章不存在！';
        } else {
            $this->msg->status = true;
            $this->msg->data = $data;
        }
        return $this->msg;
    }
}