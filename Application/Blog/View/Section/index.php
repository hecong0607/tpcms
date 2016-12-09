<link href="__PUBLIC__/blog/css/min.css" rel="stylesheet">
<script src="__PUBLIC__/blog/js/bootstrap.min.js"></script>
<div class="fullbox_excerpt">
    <div class="fullbox_content">
        <h3>以图明志</h3>
        <div class="smooth_gallery">
            <div id="myCarousel" class="carousel slide clearfix">
                <ol class="carousel-indicators">
                    <?php $num = 0;foreach($ambition as $k=>$v){ $num++; ?>
                        <li data-target="#myCarousel" data-slide-to="{$num}" class="<?=$num==1?'active':''; ?>"></li>
                    <?php }?>
                </ol>
                <div class="carousel-inner">
                    <?php $num = 0;foreach($ambition as $k=>$v){ $num++; ?>
                    <div  class="item <?=$num==1?'active':''; ?>">
                        <a href="javascript:void(0);">
                            <img src="{$v['face']}" alt="{$v['name']}">
                            <div class="carousel-caption">
                                <h4>{$v['name']}</h4>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" id="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <script type="text/javascript">
                $('.carousel').carousel({
                    interval: 5000
                })
            </script>
        </div>
    </div>
</div>
<?php foreach($articles['list'] as $k=>$v){ ?>
<div class="fullbox">
    <h3>{$v['name']}</h3>
    <div class="fullbox_content">
        <h1>
            <span class="special"></span>
            <a href="{:U('Article/'.$v['id'])}" rel="bookmark" target="_blank">{$v['title']}</a></h1>
        <span class="vicetitle" style="display: none;">副标题</span>

        <div class="post_info">
            <div class="post_info_left">
                <div class="nmtags" style="position: relative;"><?php if(!empty($v['tags'])){ $tags = explode('，', $v['tags']);?>
                    <?php $num=1; foreach($tags as $key=>$value){ ?>
                        <a href="{:U('tag/'.$value)}" rel="nofollow">{$value}</a>
                        <?php $num ++; if($num>6){break;}} }?>
                </div>
                <span>在 {:date('Y年m月d日',$v['create_time'])} 那天写的</span></div>
            <div class="post_info_right">
                <span>{$v['view']} views</span>
            </div>
        </div>
        <div class="post_content">{$v['summary']}<p class="morelink"><a
                    href="{:U('Article/'.$v['id'])}" class="more-link" target="_blank">阅读全文 &gt;&gt;</a></p>
        </div>
    </div>
    <div class="fullbox_footer"></div>
</div>
<?php } ?>
<div style="clear: both;"> </div>
<div class="manu">{$articles['page']}</div>
