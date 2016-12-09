<?php
namespace Article\Model;

use Common\Controls\Model;

/**
 * Class ArticleSecModel
 * @package Article\Model
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
     * 修改获取数据，根据id
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function getDataByIdSave($id)
    {
        $where = array();
        $where['id'] = $id;

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
                'parent_id'    => (int)$this->parent_id,
                'list_order'    => (int)$this->list_order,
                'content' => $this->content,
                'face' => $this->face,
                'thumb' => $this->thumb,
                'status' => ((int)$this->status == self::Enabled) ? self::Enabled : self::Disable,
                'type' => ((int)$this->type == self::Article) ? self::Article : self::Face,
            );
            if (empty($this->id)) {
                $data['create_time'] = time();
                $data['user_id'] = $this->user_id;
                $result = $this->add($data);
            } else {
                $data['update_time'] = time();
//                $result = $this->where(array('id' => $this->id, 'user_id' => $this->user_id))->save($data);
                $result = $this->where(array('id' => $this->id))->save($data);
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
     * 获取数据，并分页，返回数据--废弃
     * @param $select
     * @return \Common\Controls\Msg
     */
    private function getList1($select)
    {
        $where = array();
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
     * 获取栏目列表数据，无条件，所有栏目
     * @return \Common\Controls\Msg
     */
    public function getList()
    {
        $data = [];
        $base = array(
            'void'     => '&nbsp;&nbsp;&nbsp;',
            'end'      => '└&nbsp;&nbsp;',
            'continue' => '├&nbsp;&nbsp;',
            'left'     => '│&nbsp;&nbsp;',
        );
        $before = '&nbsp;&nbsp;&nbsp;';
        $field = 'id,name,parent_id,parent_id,user_id,face,thumb,status,type,list_order,create_time,update_time';
        $where = array();
        $this->recursion(0, $data, $base, $before, $where, $field);
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
//        $where = array(
//            'status' => self::Enabled,
//        );
//        $this->msg->data = $this->where($where)->select();
//        return $this->msg;
        $data = [];
        $base = array(
            'void'     => '&nbsp;&nbsp;&nbsp;',
            'end'      => '└&nbsp;&nbsp;',
            'continue' => '├&nbsp;&nbsp;',
            'left'     => '│&nbsp;&nbsp;',
        );
        $before = '&nbsp;&nbsp;&nbsp;';
        $field = 'id,name';
        $where = array(
            'status' => self::Enabled,
        );
        $this->recursion(0, $data, $base, $before, $where, $field);
        $this->msg->data = $data;
        return $this->msg;

    }

    /**
     * 返回所有栏目数据，所谓修改栏目时，上级的选择,当前只做两级制度，于是只显示以及
     * @param int $id
     * @return \Common\Controls\Msg
     */
    public function getSectionAll($id = 0)
    {
//        $data = [];
//        $base = array(
//            'void'     => '&nbsp;&nbsp;&nbsp;',
//            'end'      => '└&nbsp;&nbsp;',
//            'continue' => '├&nbsp;&nbsp;',
//            'left'     => '│&nbsp;&nbsp;',
//        );
//        $before = '&nbsp;&nbsp;&nbsp;';
//        $field = 'id,name';
        $where = array('id' => array('neq', (int)($id)),'parent_id' => 0);
//        $this->recursion(0, $data, $base, $before, $where, $field);
        $data = $this->where($where)->select();
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 递归：行结构
     * @param int $id       无限级的父id
     * @param array $data   用于返回的数据
     * @param array $base   left的选项数据
     * @param string $before left的填充数据
     * @param array $whereTemp  where的条件
     * @param string $field     筛选显示的数据
     * @param int $level        等级
     * @return null             不直接返回数据，使用引用，$data作为返回数据
     */
    protected function recursion($id = 0, &$data, $base = array(), $before = '&nbsp;&nbsp;&nbsp;', $whereTemp = array(), $field = '*', $level = 1)
    {
        $where = $whereTemp;
        $where['parent_id'] = $id;
        $result = $this->where($where)->field($field)->order('list_order')->select();
        if (empty($result)) {
            return null;
        } else {
            $count = count($result) - 1;
            foreach ($result as $k => &$v) {
                $v['level'] = $level;
                if ($count == $k) {
                    $v['left'] = $before . $base['end'];
                    $data[] = $v;
                    $this->recursion($v['id'], $data, $base, $before . $base['void'], $whereTemp, $field, $level + 1);
                } else {
                    $v['left'] = $before . $base['continue'];
                    $data[] = $v;
                    $this->recursion($v['id'], $data, $base, $before . $base['left'], $whereTemp, $field, $level + 1);
                }
            }
        }
    }

    /***
     * 前台获取
     */
    /**
     * 获取数据，根据id
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function getHomeDataById($id)
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

}