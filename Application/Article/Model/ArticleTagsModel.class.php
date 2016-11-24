<?php
namespace Article\Model;

use Common\Controls\Model;

class ArticleTagsModel extends Model
{
    protected $tableName = 'article_tags';
    const Enabled = 1;
    const Disable = 0;

}