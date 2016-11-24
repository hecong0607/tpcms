<?php
namespace Article\Model;

use Common\Controls\Model;

class ArticleTagsMapModel extends Model
{
    protected $tableName = 'article_tags_map';
    const Enabled = 1;
    const Disable = 0;

}