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
 * @property string $summary
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

    /**
     * 文章保存操作
     * @return \Common\Controls\Msg
     */
    public function doSave()
    {
        $this->checkSave();
        if ($this->msg->status == true) {
            $data = array(
                'title'    => $this->title,
                'content' => $this->content,
                'summary' => $this->summary,
                'face' => $this->face,
                'tags' => $this->tags,
                'section_id' => $this->section_id,
                'status'  => ((int)$this->status==1)?self::Enabled:self::Disable,
            );
            $newArr = explode('，',$data['tags']);
            if (empty($this->id)) {
                $data['create_time'] = time();
                $data['user_id'] = $this->user_id;
                $result = $this->add($data);
                $articleId = $result;
                $tagsDel = array();
                $tagsAdd = $newArr;
            } else {
                $data['update_time'] = time();
                $where = array('id' => $this->id,'user_id'=>$this->user_id);
                $res = $this->where($where)->find();
                $result = $this->where($where)->save($data);
                $oldArr = explode('，',$res['tags']);
                $same = array_intersect($oldArr,$newArr);
                $tagsDel = array_diff($oldArr,$same);
                $tagsAdd = array_diff($newArr,$same);
                $articleId = $res['id'];
            }
            if ($result === false) {
                $this->msg->status = false;
                $this->msg->content = '保存失败！';

            } else {
                //标签新增
                $tagsMapModel = new ArticleTagsMapModel();
                $tagsMapModel->doSave($tagsAdd,$articleId);
                //删除旧标签
                $tagsMapModel->delByData($tagsDel,$articleId);

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

    /**
     * 删除数据逻辑，返回删除结果
     * @param $uid
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function del($uid, $id)
    {
        $where = array(
            'id' =>$id,
            'user_id' =>$uid,
        );
        $data = $this->where($where)->find();
        $result = $this->where($where)->delete();

        if ($result == false) {
            $this->msg->status = false;
            $this->msg->content = '删除失败！';
        } else {
            //删除旧标签
            $oldArr = explode('，',$data['tags']);
            $tagsMapModel = new ArticleTagsMapModel();
            $tagsMapModel->delByData($oldArr,$id);

            $this->msg->status = true;
            $this->msg->content = '删除成功！';
        }
        return $this->msg;
    }
}