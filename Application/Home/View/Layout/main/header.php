<div id="header">
    <div id="service-list">
        <div id="service-list-inner" class="clearfix">
            <div id="sub-title"><?= \Admin\Model\ConfigModel::getDataByName('site_head_right_title');?></div>
            <ul>
                <li><a href="javascript:void(0);" target="_blank"><?= \Admin\Model\ConfigModel::getDataByName('site_name');?><span style="color: #FFF200;">Hot!</span></a></li>
                <li><a href="/" target="_blank"><?= \Admin\Model\ConfigModel::getDataByName('site_head_left_title');?></a></li>
            </ul>
        </div>
    </div>
    <div id="header-inner" class="clearfix">
        <div id="produced-by"> </div>
        <div id="title"> </div>
    </div>
    <div id="global-nav">
        <div id="global-nav-inner">
            <ul class="clearfix">
                <li class="order-reload "><a style="padding:0;" href="/" title="<?= \Admin\Model\ConfigModel::getDataByName('site_head_right_title');?>"><img style="height: 39px;vertical-align: top;display: block;" src="<?= \Admin\Model\ConfigModel::getDataByName('site_logo');?>"></a></li>
                <li class="order order-new"><a href="/"><span class="png">首页</span></a></li>
                <li class="order order-hot"><a href="{:U('/Blog')}"><span class="png">博客</span></a></li>
            </ul>
        </div>
    </div>
</div>
