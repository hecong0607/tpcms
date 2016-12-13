<div id="top_area">
    <div id="top_area_content">
        <div class="left">
            <ul>
                <li><a href="/">网站首页</a></li>
                <li><a href="{:U('/Blog')}">博客</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="header">
    <div id="header_content">
        <div id="logo">
            <h1><a href="{:U('/Blog')}" title="<?= \Admin\Model\ConfigModel::getDataByName('site_head_right_title');?>"><img style="height: 42px;" src="<?= \Admin\Model\ConfigModel::getDataByName('site_logo');?>"></a><span style="margin-left:10px;;margin-top: 10px;position: absolute;"><?= \Admin\Model\ConfigModel::getDataByName('site_head_right_title');?></span></h1>
        </div>

    </div>
</div>
<?php $secModel = new \Blog\Model\ArticleSecModel();$sec_header = clone $secModel->getBlogSec();?>
<div id="navigation_area">
    <ul id="nav">
        <?php foreach($sec_header->data as $k=>$v){ ?>
        <li class="cat-item"><a href="{:U('/Blog/Section/'.$v['id'])}" class="mainMenuParentBtn mainParentBtn">{$v['name']}</a></li>
        <?php } ?>
    </ul>
</div>