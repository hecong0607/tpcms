<?php
namespace Article\Model;

use Common\Controls\Model;

class ArticleModel extends Model
{
    protected $tableName = 'article';
    const Enabled = 1;
    const Disable = 0;

}