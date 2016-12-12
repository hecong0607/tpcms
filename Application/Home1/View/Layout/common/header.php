<?php
$sectionModel = new \Article\Model\ArticleSecModel();
$header_sections = $sectionModel->getDataAll()->data;
?>
<header id="vmaig-header" class="navbar navbar-inverse navbar-fixed-top navbar-vmaig">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#vmaig-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">河淙</div>
        </div>
        <div class="collapse navbar-collapse" id="vmaig-navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="/">
                        <span class="glyphicon glyphicon-home"></span>
                        首页
                    </a>
                </li>
                <li class="article_all">
                    <a href="{:U('articles/all')}">
                        <span class="glyphicon glyphicon-globe"></span>
                        全部文章
                    </a>
                </li>
                <?php foreach($header_sections as $k=>$v){ ?>
                <li class="section_{$v['id']}"><a href="{:U('Section/'.$v['id'])}">{$v['name']}</a></li>
                <?php } ?>


            </ul>
            <ul class="nav navbar-nav navbar-right hidden">
                <li>
                    <a id="nav-login" data-toggle="modal" data-target="#login-modal"
                       style="padding-right:0px;cursor:pointer;">
                        登陆
                    </a>
                </li>
                <li>
                    <a id="nav-register" data-toggle="modal" data-target="#register-modal"
                       style="padding-right:0px;cursor:pointer">
                        注册
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
