<?php
namespace Blog\Model;

use Common\Controls\Model;

/**
 * Class Blog
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
 * @property integer $popular
 * @property integer $recommend
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
     * 根据栏目id获取数据，详情除外，限制10
     * @param $section_id
     * @return \Common\Controls\Msg
     */
    public function getDataBySectionId($section_id)
    {
        //已发布，并且已经审核
        $where = array(
            'section_id' => (int)$section_id,
            'status' => self::Enabled,
            'flag' => self::Pended,
        );
        $limit = 10;
        $data = $this->where($where)->field(array('content'), true)->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }
    /**
     * 获取最新数据，详情除外，限制10
     * @return \Common\Controls\Msg
     */
    public function getDataByNew()
    {
        $db_prefix = C('DB_PREFIX');
        $join = 'left join ' . $db_prefix . 'article_section as b on a.section_id=b.id ';
        $where = array(
            'a.status' => self::Enabled,
            'a.flag' => self::Pended,
            'b.parent_id' => ArticleSecModel::BlogId,
        );
        $alias = 'a';
        $limit = 10;
        $field = 'a.id, a.title, a.create_time';
        $data = $this->where($where)->alias($alias)->join($join)->field($field)->order('a.create_time desc')->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 获取图片数据，详情除外，限制1
     * @return \Common\Controls\Msg
     */
    public function getDataByPhoto()
    {
        $section_id = ArticleSecModel::PhotoId;
        //已发布，并且已经审核
        $where = array(
            'section_id' => (int)$section_id,
            'status' => self::Enabled,
            'flag' => self::Pended,
        );
        $data = $this->where($where)->field(array('content'), true)->order('create_time desc')->find();
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 网站右侧栏目,限制3
     * @return \Common\Controls\Msg
     */
    public function getHomeRight()
    {
        $section_id = ArticleSecModel::HomeRight;
        $where = array(
            'section_id' => $section_id,
            'status' => self::Enabled,
            'flag' => self::Pended,
        );
        $limit = 3;
        $data = $this->where($where)->field('title,content')->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 获取热门博文，限制5
     * @return \Common\Controls\Msg
     */
    public function getPopular()
    {
        //获取博客下的栏目
        $secModel = new ArticleSecModel();
        $blogSecIds = $secModel->getBlogSecIds();

//        $section_id = 4;
        //已发布，并且已经审核
        $where = array(
            'section_id' => 0,  //默认为0
            'status' => self::Enabled,
            'flag' => self::Pended,
        );
        if(!empty($blogSecIds)){
            $where['section_id'] = array('in',$blogSecIds);
        }
        $limit = 5;
        $data = $this->where($where)->field(array('content'), true)->order('view desc')->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }
    /**
     * 获取推荐，限制5,不一定是博文
     * @return \Common\Controls\Msg
     */
    public function getRecommend()
    {
        //已发布，并且已经审核
        $where = array(
            'status' => self::Enabled,
            'flag' => self::Pended,
            'recommend' =>self::Enabled,
        );
        $limit = 5;
        $data = $this->where($where)->field(array('content'), true)->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }
    /**
     * 获取友情链接，限制20,不一定是博文
     * @return \Common\Controls\Msg
     */
    public function getLinks()
    {
        $section_id = ArticleSecModel::HomeLinks;
        //已发布，并且已经审核
        $where = array(
            'section_id' => $section_id,
            'status' => self::Enabled,
            'flag' => self::Pended,
        );
        $limit = 20;
        $data = $this->where($where)->field(array('content'), true)->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }
    /**
     * 获取以图明志，限制20,不一定是博文
     * @return \Common\Controls\Msg
     */
    public function getAmbition()
    {
        $section_id = ArticleSecModel::Ambition;
        //已发布，并且已经审核
        $where = array(
            'section_id' => $section_id,
            'status' => self::Enabled,
            'flag' => self::Pended,
        );
        $limit = 20;
        $data = $this->where($where)->field(array('content'), true)->limit($limit)->select();
        $this->msg->data = $data;
        return $this->msg;
    }

    /**
     * 根据$select获取文章列表数据,$select:section_id、tag_name
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
            'b.parent_id' => ArticleSecModel::BlogId,
        );
        if(!empty($select['section_id'])){
            $where['a.section_id'] = (int)$select['section_id'];
        }
        if(!empty($select['tag_name'])){
            $where['a.tags'] = array('like','%'.$select['tag_name'].'%');
//            $where['d.name'] = $select['tag_name'];
//            $join .= ' left join ' . $db_prefix . 'article_tags_map as c on c.article_id=a.id ';
//            $join .= ' left join ' . $db_prefix . 'article_tags as d on d.id=c.tag_id ';
        }

        $alias = 'a';
        $count = (int)$this->where($where)->alias($alias)->join($join)->count();

        $field = 'a.id, a.section_id, a.title, a.view, a.face, a.summary, a.tags, a.status, a.flag, a.create_time, b.name';
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
     * 根据$select获取文章详情数据
     * @param array $select
     * @return \Common\Controls\Msg
     */
    public function getHomeDetail($select = array())
    {
        $where = array(
            'a.status' => self::Enabled,
            'a.flag' => self::Pended,
            'a.id' => (int)$select['articleId'],
            'b.parent_id' => ArticleSecModel::BlogId,
        );
        $db_prefix = C('DB_PREFIX');
        $join = 'left join ' . $db_prefix . 'article_section as b on a.section_id=b.id ';
        $join .= 'left join ' . $db_prefix . 'admin_user as c on c.id=a.user_id ';
        $alias = 'a';
        $field = 'a.id, a.section_id, a.title, a.view, a.face, a.summary, a.content, a.tags, a.status, a.flag, a.create_time, b.name,c.realname';
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

}