<!-- 文章列表 与 侧边的东西 -->
<style type="text/css">
    .img{}
</style>
<div id="vmaig-content" class="col-md-8 col-lg-9">
    <div class="well">
        {:htmlspecialchars_decode($section['content'])}
    </div>
    <div class="well">
        <?php if(!empty($article['list'])){ ?>
            <?php foreach($article['list'] as $k=>$v){ ?>
            <div class="all-post clearfix underline">
                <div class="post-title clearfix">
                    <a href="{:U('Section/'.$v['section_id'])}">
                        <div class="pre-cat">
                            <div class="pre-catinner btn">{$section['name']}</div>
                            <div class="pre-catarrow">
                            </div>
                        </div>
                    </a>

                    <h1><a href="{:U('articles/'.$v['id'])}">{$v['title']}</a></h1>
                    <span class="visible-xs-inline-block" style="margin-top:7px;">{:date('Y-m-d',$v['create_time'])}</span>
                    <div class="post-tags"><?php $tags = explode('，', $v['tags']);?>
                        <?php $num=1; foreach($tags as $key=>$value){ ?>
                        <a href="{:U('tag/'.$value)}">
                            <span class="label label-vmaig-{$num} btn">{$value}</span>
                        </a>
                        <?php $num ++; if($num>6){break;}} ?>
                    </div>
                </div>
                <div class="post-content ">
                    <div class="row">
                        <div class="col-sm-4">
                            <figure class="thumbnail">
                                <a href="{:U('articles/'.$v['id'])}">
                                    <img  src="{$v['face']|default='/Public/Home/images/default_article.png'}" height="400" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="col-sm-8" style="font-size: 15px;">
                            <p>{$v['summary']}</p>
                        </div>
                    </div>
                </div>
                <div class="post-info hidden-xs">
                <span>
                    <span class="glyphicon glyphicon-calendar"></span>
                    {:date('Y-m-d',$v['create_time'])}
                </span>
                <span class="hidden">
                    <span class="glyphicon glyphicon-comment"></span>
                    0
                </span>
                <span class="hidden">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    764
                </span>
                </div>
            </div>
            <?php } ?>
            <div class="manu">{$article['page']}</div>
        <?php } else { ?>
            <h1 style="text-align: center;">暂无信息</h1>
        <?php }?>
    </div>
</div>
<script type="text/javascript">
    $(".section_{$section['id']}").addClass('active');
</script>