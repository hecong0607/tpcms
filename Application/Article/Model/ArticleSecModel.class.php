<?php
namespace Article\Model;

use Common\Controls\Model;

class ArticleSecModel extends Model
{
    protected $tableName = 'article_section';
    const Enabled = 1;
    const Disable = 0;

}