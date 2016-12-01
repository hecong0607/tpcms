<?php
namespace Article\Model;

use Common\Controls\Model;

/**
 * Class ArticleTagsModel
 * @package Article\Model
 *
 * @property integer $id
 * @property string $name
 * @property integer $num
 */
class ArticleTagsModel extends Model
{
    protected $tableName = 'article_tags';

    /**
     * 保存标签（新增或者修改），并返回该标签的id
     * @param $name
     * @return mixed
     */
    public function doSave($name)
    {
        $data = $this->where(array('name' => $name))->find();
        if (empty($data)) {
            $id = $this->data(array('name'=>$name,'num'=>1))->add();
        } else {
            $this->where(array('id'=>$data['id']))->setInc('num',1);
            $id = $data['id'];
        }
        return $id;
    }

    /**
     * 对删除的关系进行标签减1
     * @param $data
     */
    public function delByMap($data)
    {
        if(is_array($data)) {
            foreach ($data as $k => $v) {
                $where = array('id' => $v['tag_id']);
                $result = $this->where($where)->find();
                if (!empty($result)) {
                    $this->where($where)->setDec('num', 1);
                }
            }
        }
    }

    /**
     * 对删除的标签减1,并返回标签id
     * @param $name
     * @return int
     */
    public function delByName($name)
    {

        $where = array('name' => $name);
        $res = $this->where($where)->find();
        if (!empty($res)) {
            $where = array('id'=>$res['id']);
            $this->where($where)->setDec('num', 1);
            $result = $res['id'];
        } else {
            $result = 0;
        }
        return $result;
    }

    /**
     * 获取标签列表
     * @return \Common\Controls\Msg
     */
    public function getList($select){
        $where = array();
        if($select['name']!=''){
            $where['name'] = array('like','%'.$select['name'].'%');
        }
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
}