<!-- 文章列表 与 侧边的东西 -->
<div id="vmaig-content" class="col-md-8 col-lg-9">
    <!-- 警告框 -->
    <div class="well alert hidden-xs fade in hidden">
        <button class="close" data-dismiss="alert" type="button">&times;</button>
        欢迎来到
        <a href="/">河淙个人博客</a>
    </div>
    <div class="visible-xs hidden">
        <div class="search">
            <form class="form-inline clearfix" role="form" method="get" action="/search/">
                <input type="text" class="form-control" id="top-s" name="s">
                <button class="btn btn-vmaig">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>
        </div>
    </div>
    <!-- 首页文章列表 -->
    <div id="home-post-list">
        <!-- 首页轮播 -->
        <div id="myCarousel" class="carousel slide clearfix">
            <ol class="carousel-indicators">
                <?php $num = 0; foreach($section as $k=>$v){ ?>
                <li data-target="#myCarousel" data-slide-to="{$num}" class="<?=$num==0?'active':''?>"></li>
                <?php $num++; } ?>
            </ol>

            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner" style="height: 490px;">
                <?php $num = 0; foreach($section as $k=>$v){ ?>
                <div  class="item <?=$num==0?'active':''?>">
                    <a href="{:U('Section/'.$v['id'])}">
                        <img src="{$v['face']}" alt="{$v['name']}">
                        <div class="carousel-caption">
                            <h4>{$v['name']}</h4>
                        </div>
                    </a>
                </div>
                <?php $num++; } ?>
            </div>
            <!-- 轮播（Carousel）导航 -->
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
            function carousel(){
                $('#next').click();
                setTimeout("carousel()",2000);
            }
            $(document).ready(function(){
                setTimeout("carousel()",2000);
            });
        </script>
        <!--首页文章列表 -->
        <div class="home-post well clearfix">
        <?php if(!empty($articles['list'])){ ?>
            <?php foreach($articles['list'] as $k=>$v){ ?>
                    <div class="post-title underline clearfix">
                        <?php if(!empty($v['section_id'])){ ?>
                            <a href="{:U('Section/'.$v['section_id'])}">
                                <div class="pre-cat">
                                    <div class="pre-catinner btn">{$v['name']}</div>
                                    <div class="pre-catarrow">
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                        <h1><a href="{:U('articles/'.$v['id'])}">{$v['title']}</a></h1>
                        <div class="post-info"><?php $tags = explode('，', $v['tags']);?>
                            <span><span class="glyphicon glyphicon-calendar"></span> {:date('Y-m-d',$v['create_time'])}</span>
                            <span class="hidden"><span class="glyphicon glyphicon-comment"></span>70</span>
                            <span class="hidden"><span class="glyphicon glyphicon-eye-open"></span>6139</span>
                            <div class="post-tags"><?php $tags = explode('，', $v['tags']);?>
                                <?php $num=1; foreach($tags as $key=>$value){ ?>
                                    <a href="{:U('tag/'.$value)}">
                                        <span class="label label-vmaig-{$num} btn">{$value}</span>
                                    </a>
                                    <?php $num ++; if($num>6){break;}} ?>
                            </div>
                        </div>
                    </div>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-sm-4">
                                <figure class="thumbnail">
                                    <a href="{:U('articles/'.$v['id'])}">
                                        <img  src="{$v['face']|default='/Public/Home/images/default_article.png'}" height="300" alt="">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-sm-8">
                                <p>{$v['summary']}</p>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            <div class="manu">{$articles['page']}</div>
        <?php } else { ?>
            <h1 style="text-align: center;">暂无信息</h1>
        <?php }?>
        </div>
    </div>
</div>

