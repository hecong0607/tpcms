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
     * 获取个人的标签
     */
    public function getMyList(){

    }
}