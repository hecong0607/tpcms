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
            <h1><a href="{:U('/Blog')}">愿青龙指引你</a></h1>
            <h2>成功，唯有积累，没有奇迹</h2>
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