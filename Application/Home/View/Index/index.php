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
                    <a href="javascript:void(0);">
                        <img src="{$v['face']}" alt="{$v['name']}">
                        <div class="carousel-caption">
                            <h4>测试1</h4>
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
            <div class="post-title underline clearfix">
                <a href="javascript:void(0);">
                    <div class="pre-cat">
                        <div class="pre-catinner btn">
                            tag
                        </div>
                        <div class="pre-catarrow">
                        </div>
                    </div>
                </a>

                <h1>
                    <a href="javascript:void(0);">标题1</a>
                </h1>

                <div class="post-info">
            <span>
                <span class="glyphicon glyphicon-calendar"></span>
                2015-05-15
            </span>
            <span class="hidden">
                <span class="glyphicon glyphicon-comment"></span>
                70
            </span>
            <span>
                <span class="glyphicon glyphicon-eye-open"></span>
                6139
            </span>
                    <div class="post-tags">
                        <a href="/tag/tag1/" class=" ">
                            <span class="label label-vmaig-1 btn">tag1</span>
                        </a>
                        <a href="/tag/tag2/" class="hidden-xs ">
                            <span class="label label-vmaig-2 btn">tag2</span>
                        </a>
                        <a class="visible-xs-inline-block">
                            <span class="label label-vmaig-2 btn ">...</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="post-content">
                <div class="row">
                    <div class="col-sm-4">
                        <figure class="thumbnail">
                            <a href="javascript:void(0);">
                                <img src="__PUBLIC__/Home/images/default.jpg" height="300" alt="">
                            </a>
                        </figure>
                    </div>
                    <div class="col-sm-8">
                        <p>更新日志</p>
                        <a type="button" class="btn btn-vmaig pull-right hidden-xs"
                           href="javascript:void(0);">阅读全文</a>
                    </div>
                </div>
            </div>
        </div>


        <!--分页 -->

        <ul class="pager">

            <li class="previous disabled">
                <a>&larr; 上一页</a>
            </li>

            <li class="page-number">1/9</li>

            <li class="next">
                <a href="?page=2">下一页 &rarr;</a>
            </li>

        </ul>

    </div>
</div>

