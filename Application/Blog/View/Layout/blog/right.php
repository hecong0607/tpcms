<div id="sidebar_top">
    <div class="box">
        <h3>时不我待</h3>

        <div class="box_content">
            <div style="overflow:hidden; height:67px;">
                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="" width="100%" height="100%" id="xt_home_map"
                        align="middle">
                    <embed src="__PUBLIC__/blog/images/clock.swf" quality="high" bgcolor="#ffffff" width="100%"
                           height="100%" wmode="transparent" name="xt_home_map" align="middle" allowscriptaccess="sameDomain"
                           allowfullscreen="false" type="application/x-shockwave-flash"
                           pluginspage="http://www.adobe.com/go/getflashplayer_cn">
                </object>
            </div>
        </div>
        <div class="box_bottom"></div>
    </div>
    <div class="box">
        <h3>热门博文</h3>

        <div class="box_content">
            <ul>
                <?php $articleModel = new \Blog\Model\ArticleModel();$popular_right = clone $articleModel->getPopular(); foreach($popular_right->data as $key=>$value){ ?>
                    <li><a href="{:U('/Blog/Article/'.$value['id'])}" target="_blank">{$value['title']}</a>
                        <span> {$value['view']} views </span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="box_bottom"></div>
    </div>
</div>
<div id="sidebar_top">
<!--<div id="sidebar_left">-->
    <div class="box" style="display: none;">
        <h3>文章分类</h3>

        <div class="box_content">
            <ul>
                <li><a href="http://www.nowamagic.net/librarys/veda/cate/PHP">PHP服务器脚本</a> <span>( 473 )</span></li>
            </ul>
        </div>
        <div class="box_bottom"></div>
    </div>
    <div class="box">
        <h3>其它</h3>

        <div class="box_content">
            <ul class="clearfix"><?php $recommend_right = clone $articleModel->getRecommend(); foreach($recommend_right->data as $k=>$v){ ?>
                    <li><a href="{:U('/Blog/Article/'.$v['id'])}" rel="nofollow" target="_blank">{$v['title']}</a></li>

                <?php } ?>
            </ul>
        </div>
        <div class="box_bottom"></div>
    </div>
</div>
<div id="sidebar_right" style="display: none;">
    <div class="box">
        <h3>按月归档</h3>

        <div class="box_content">
            <ul>
                <li><a href="http://www.nowamagic.net/librarys/veda/achive/2016-11">2016-11</a> <span>( 1 )</span></li>
            </ul>
        </div>
        <div class="box_bottom"></div>
    </div>
</div>