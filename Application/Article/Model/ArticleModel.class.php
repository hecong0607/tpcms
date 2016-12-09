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
 * @property string $thumb
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $tags
 * @property integer $view
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 * @property integer $flag
 */
class ArticleModel extends Model
{
    protected $tableName = 'article';
    const Enabled = 1;      //发布
    const Disable = 0;      //待发布

    const AdminUid = -1;    //管理员id

    const Pended = 0;    //审核通过
    const PendingEditing = 1;    //待审核-未修改
    const PendingEdited = 0;   //待审核已经修改

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
                'title'      => $this->title,
                'content'    => $this->content,
                'summary'    => $this->summary,
                'face'       => $this->face,
                'thumb'      => $this->thumb,
                'tags'       => $this->tags,
                'section_id' => $this->section_id,
                'status'     => ((int)$this->status == 1) ? self::Enabled : self::Disable,
            );
            $newArr = explode('，', $data['tags']);
            if (empty($this->id)) {             //新增
                $data['flag'] = self::Pended;
                $data['create_time'] = time();
                $data['user_id'] = $this->user_id;
                $result = $this->add($data);
                $articleId = $result;
                $tagsDel = array();
                $tagsAdd = $newArr;
            } else {                            //修改
                $data['update_time'] = time();
                $where = array('id' => $this->id, 'user_id' => $this->user_id);
                $res = $this->where($where)->find();
                if ($res['flag'] == self::PendingEditing) {   //待审核未修改
                    $data['flag'] = self::PendingEdited;    //待审核已修改
                }
                $result = $this->where($where)->save($data);
                $oldArr = explode('，', $res['tags']);
                $same = array_intersect($oldArr, $newArr);
                $tagsDel = array_diff($oldArr, $same);
                $tagsAdd = array_diff($newArr, $same);
                $articleId = $res['id'];
            }
            if ($result === false) {
                $this->msg->status = false;
                $this->msg->content = '保存失败！';

            } else {
                //标签新增
                $tagsMapModel = new ArticleTagsMapModel();
                $tagsMapModel->doSave($tagsAdd, $articleId);
                //删除旧标签
                $tagsMapModel->delByData($tagsDel, $articleId);

                $this->msg->status = true;
                $this->msg->content = '保存成功';
            }
        }
        return $this->msg;
    }

    /**
     * 获取数据，并分页，返回数据
     * @param $uid
     * @param $select
     * @return \Common\Controls\Msg
     */
    public function getList($uid, $select)
    {

        $where = array('user_id' => (int)$uid);
        if (!empty($select['title'])) {
            $where['title'] = array('like', '%' . $select['title'] . '%');
        }
        if (!empty($select['start_time'])) {
            $where['create_time'] = array('EGT', $select['start_time']);
        }
        if (!empty($select['end_time'])) {
            $where['create_time'] = array('ELT', $select['end_time']);
        }
        if (!empty($select['section_id'])) {
            $where['section_id'] = $select['section_id'];
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
     * 获取数据，根据id或者uid和id
     * @param string $uid
     * @param $id
     * @return \Common\Controls\Msg
     */
    public function getDataById($id, $uid)
    {
        $where = array();
        $where['id'] = (int)$id;
        $where['user_id'] = (int)$uid;

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
            'id'      => $id,
            'user_id' => $uid,
        );
        $data = $this->where($where)->find();
        $result = $this->where($where)->delete();

        if ($result == false) {
            $this->msg->status = false;
            $this->msg->content = '删除失败！';
        } else {
            //删除旧标签
            $oldArr = explode('，', $data['tags']);
            $tagsMapModel = new ArticleTagsMapModel();
            $tagsMapModel->delByData($oldArr, $id);

            $this->msg->status = true;
            $this->msg->content = '删除成功！';
        }
        return $this->msg;
    }

    /**
     * 根据栏目id获取文章数量，返回数量
     * @param $section_id
     * @return int
     */
    public function getCountBySection($section_id)
    {
        $where = array(
            'section_id' => (int)$section_id,
            'status'     => self::Enabled,
        );
        $count = $this->where($where)->count();
        return (int)$count;
    }

    /**
     * 设置发布状态
     * @param $id
     * @param $uid
     * @return \Common\Controls\Msg
     */
    public function setStatus($id, $uid)
    {
        $where = array('id' => $id, 'user_id' => $uid);
        $article = $this->where($where)->field(array('content'), true)->find();
        if ($article['flag'] != self::Pended) {
            $this->msg->status = false;
            $this->msg->content = '审核未通过，设置失败！';
        } else {
            $data = array();
            if ($article['status'] == self::Enabled) {
                $data['status'] = self::Disable;
            } else {
                $data['status'] = self::Enabled;
            }
            $result = $this->where($where)->save($data);
            if ($result == false) {
                $this->msg->status = false;
                $this->msg->content = '设置失败！';
            } else {
                $this->msg->status = true;
                $this->msg->content = '设置成功！';
            }
        }
        return $this->msg;
    }

    /**
     * 设置审核(通过与未通过待修改)
     * @param $id
     * @param $flag
     * @return \Common\Controls\Msg
     */
    public function setPendAdmin($id, $flag)
    {
        $where = array('id' => $id);
        $data = array();
        if ($flag == self::Pended) {
            $data['flag'] = self::Pended;
        } else {
            $data['flag'] = self::PendingEditing;
        }
        $data['status'] = self::Disable;
        $result = $this->where($where)->save($data);
        if ($result == false) {
            $this->msg->status = false;
            $this->msg->content = '设置失败！';
        } else {
            $this->msg->status = true;
            $this->msg->content = '设置成功！';
        }
        return $this->msg;
    }

    /**
     * 设置属性
     * @param $id
     * @param $AttributesArray
     * @return \Common\Controls\Msg
     */
    public function setAttributesAdmin($id, $AttributesArray)
    {
        $where = array('id' => $id);
        $article = $this->where($where)->field(array('content'), true)->find();

        $data = array();
        foreach($AttributesArray as $k => $v) {
            if ($article[$v] == self::Enabled) {
                $data[$v] = self::Disable;
            } else {
                $data[$v] = self::Enabled;
            }
        }
        $result = $this->where($where)->save($data);
        if ($result == false) {
            $this->msg->status = false;
            $this->msg->content = '设置失败！';
        } else {
            $this->msg->status = true;
            $this->msg->content = '设置成功！';
        }

        return $this->msg;
    }

    /**
     * 获取数据，并分页，返回数据
     * @param $select
     * @return \Common\Controls\Msg
     */
    public function getLisBytAdmin($select)
    {
        $where = array();
        if (!empty($select['title'])) {
            $where['a.title'] = array('like', '%' . $select['title'] . '%');
        }
        if (!empty($select['editor'])) {
            $where['b.username'] = $select['editor'];
        }
        if (!empty($select['start_time'])) {
            $where['a.create_time'] = array('EGT', $select['start_time']);
        }
        if (!empty($select['end_time'])) {
            $where['a.create_time'] = array('ELT', $select['end_time']);
        }
        if (!empty($select['section_id'])) {
            $where['a.section_id'] = $select['section_id'];
        }

        $db_prefix = C('DB_PREFIX');
        $join = 'left join ' . $db_prefix . 'admin_user as b on a.user_id=b.id ';
        $alias = 'a';
        $count = (int)$this->where($where)->alias($alias)->join($join)->count();

        $field = array('a.id', 'a.title', 'a.summary', 'a.thumb', 'a.status', 'a.flag', 'a.popular', 'a.recommend', 'a.create_time', 'b.username', 'b.realname');
        $Page = new \Think\Page($count, $this->default_page);// 实例化分页类 传入总记录数和每页显示的记录数(30)
        $list = $this->where($where)->field($field)->alias($alias)->join($join)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $data = array(
            'page' => $Page->show(),
            'list' => $list,
        );
        $this->msg->data = $data;
        return $this->msg;
    }

    /******
     * 前台获取数据
     */
    /**
     * 根据$select获取文章列表数据
     * @param array $select
     * @param array $pageConfig
     * @return \Common\Controls\Msg
     */
    public function getHomeData($select = array(), $pageConfig = array())
    {
        $db_prefix = C('DB_PREFIX');
        $join = 'left join ' . $db_prefix . 'article_section as b on a.section_id=b.id ';
        $where = array(
            'a.status' => self::Enabled,
            'a.flag' => self::Pended,
        );
        if(!empty($select['section_id'])){
            $where['a.section_id'] = (int)$select['section_id'];
        }
        if(!empty($select['tags'])){
            $where['d.name'] = $select['tags'];
            $join .= ' left join ' . $db_prefix . 'article_tags_map as c on c.article_id=a.id ';
            $join .= ' left join ' . $db_prefix . 'article_tags as d on d.id=c.tag_id ';
        }

        $alias = 'a';
        $count = (int)$this->where($where)->alias($alias)->join($join)->count();

        $field = 'a.id, a.section_id, a.title, a.face, a.summary, a.tags, a.status, a.flag, a.create_time, b.name';
        $url = empty($pageConfig['url']) ? '' : $pageConfig['url'];
//        $this->default_page = 1;
        $Page = new \Think\Page($count, $this->default_page, array(), $url);// 实例化分页类 传入总记录数和每页显示的记录数(30)
        $list = $this->where($where)->alias($alias)->join($join)->field($field)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
//        var_dump($this->getLastSql());die;
        $data = array(
            'page' => $Page->show(),
            'list' => $list,
        );
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 根据$select获取文章列表数据
     * @param array $select
     * @return \Common\Controls\Msg
     */
    public function getHomeDetail($select = array())
    {
        $where = array(
            'a.status' => self::Enabled,
            'a.flag' => self::Pended,
            'a.id' => (int)$select['articleId'],
        );
        $db_prefix = C('DB_PREFIX');
        $join = 'left join ' . $db_prefix . 'article_section as b on a.section_id=b.id ';
        $join .= 'left join ' . $db_prefix . 'admin_user as c on c.id=a.user_id ';
        $alias = 'a';
        $field = 'a.id, a.section_id, a.title, a.face, a.summary, a.content, a.tags, a.status, a.flag, a.create_time, b.name,c.realname';
        $data = $this->where($where)->alias($alias)->join($join)->field($field)->order('id desc')->find();
        if(empty($data)){
            $this->msg->status = false;
            $this->msg->data = array();
        } else {
            $this->msg->status = true;
            $this->msg->data = $data;
        }
        return $this->msg;
    }

    /**
     * 获取推荐的文章
     * @return mixed
     */
    public function getRecommendData()
    {
        $where = array(
            'status' => self::Enabled,
            'flag' => self::Pended,
            'recommend' => self::Enabled,
        );
        $limit = 10;
        $data = $this->where($where)->field(array('content'), true)->limit($limit)->select();
        return $data;
    }

    /**
     * 获取热门的文章
     * @return mixed
     */
    public function getPopularData()
    {
        $where = array(
            'status' => self::Enabled,
            'flag' => self::Pended,
            'popular' => self::Enabled,
        );
        $limit = 10;
        $data = $this->where($where)->field(array('content'), true)->limit($limit)->select();
        return $data;
    }


}