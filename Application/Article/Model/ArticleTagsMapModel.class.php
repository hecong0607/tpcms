<?php
namespace Article\Model;

use Common\Controls\Model;

/**
 * Class ArticleTagsMapModel
 * @package Article\Model
 *
 * @property integer tag_id
 * @property integer article_id
 */
class ArticleTagsMapModel extends Model
{
    protected $tableName = 'article_tags_map';

    /**
     * 增加新的关系
     * @param $nameArray
     * @param $article_id
     * @return mixed
     */
    public function doSave($nameArray, $article_id)
    {
        $tagsModel = new ArticleTagsModel();
        $result = array();
        foreach($nameArray as $k=>$v) {
            $tagId = $tagsModel->doSave($v);
            $data = array(
                'tag_id'     => $tagId,
                'article_id' => $article_id,
            );
            $result[] = $this->data($data)->add();
        }
        return $result;
    }

    /**
     * 删除关系，并返回删除的数据
     * @param $article_id
     * @return mixed
     */
    public function delByArticleId($article_id)
    {
        $where = array('article'=>$article_id);
        $data = $this->where($where)->select();
        $this->where($where)->delete();
        return $data;
    }

    /**
     * 删除关系，并返回删除的数据
     * @param $nameArray
     * @param $article_id
     * @return array
     */
    public function delByData($nameArray, $article_id)
    {
        $tagsModel = new ArticleTagsModel();
        $result = array();
        foreach($nameArray as $k=>$v) {
            $tagId = $tagsModel->delByName($v);
            if(!empty($tagId)){
                $where = array(
                    'tag_id'     => $tagId,
                    'article_id' => $article_id,
                );
                $result[] = $this->where($where)->delete();
            }
        }
        return $result;

    }



}