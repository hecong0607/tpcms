<?php
namespace Blog\Model;

use Common\Controls\Model;

/**
 * Class ArticleTagsModel
 * @package Blog\Model
 *
 * @property integer $id
 * @property string $name
 * @property integer $num
 */
class ArticleTagsModel extends Model
{
    protected $tableName = 'article_tags';

}