<?php
namespace Article\Model;

use Common\Controls\Model;

/**
 * Class ArticleSecModel
 * @package Article\Model
 * @property integer $id
 * @property integer $user_id
 * @property string $title as $name
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 */
class ArticleSecModel extends Model
{
    protected $tableName = 'article_section';
    const Enabled = 1;
    const Disable = 0;


    /**
     * 获取数据，根据id
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function getDataById($id)
    {
        $where = array();
        $where['id'] = $id;
        $where['status'] = self::Enabled;

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
     * 验证保存的数据（新增和修改）
     */
    protected function checkSave()
    {
        $this->msg->status = true;
        if (empty($this->title)) {
            $this->msg->status = false;
            $this->msg->content = '栏目不可为空！';
            return;
        }
    }

    public function doSave()
    {
        $this->checkSave();
        if ($this->msg->status == true) {
            $data = array(
                'name'    => $this->title,
                'content' => $this->content,
                'status'  => self::Enabled,
            );
            if (empty($this->id)) {
                $data['create_time'] = time();
                $data['user_id'] = $this->user_id;
                $result = $this->add($data);
            } else {
                $data['update_time'] = time();
                $result = $this->where(array('id' => $this->id, 'user_id' => $this->user_id))->save($data);
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
     * @param $select
     * @return \Common\Controls\Msg
     */
    public function getList($select)
    {
        $where = array('status' => self::Enabled);
        if($select['name']!=''){
            $where['name'] = array('like','%' .$select['name'] . '%');
        }
        $count = (int)$this->where($where)->count();
        $Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
        $list = $this->where($where)->field(array('content'), true)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $data = array(
            'page' => $Page->show(),
            'list' => $list,
        );
        $this->msg->data = $data;
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
            'id'      => $id,
            'user_id' => $uid,
        );
        $article = new ArticleModel();
        $count = $article->getCountBySection(($id));
        if($count>0) {
            $this->msg->status = false;
            $this->msg->content = '删除失败,栏目下有文章！';
        } else {
            $result = $this->where($where)->delete();
            if ($result == false) {
                $this->msg->status = false;
                $this->msg->content = '删除失败！';
            } else {
                $this->msg->status = true;
                $this->msg->content = '删除成功！';
            }
        }
        return $this->msg;
    }

    /**
     * 获取所有栏目
     * @return \Common\Controls\Msg
     */
    public function getDataAll()
    {
        $where = array(
            'status' => self::Enabled,
        );
        $this->msg->data = $this->where($where)->select();
        return $this->msg;
    }

}