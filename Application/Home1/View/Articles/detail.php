<!-- 文章列表 与 侧边的东西 -->
<div id="vmaig-content" class="col-md-8 col-lg-9">
    <div id="article-page" class="well">
        <ol class="breadcrumb">
            <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
            <?php if(!empty($article['section_id'])){ ?>
                <li><a href="{:U('Section/'.$article['section_id'])}">{$article['name']}</a></li>
            <?php } ?>
            <li class="hidden-xs"><a><span class="glyphicon glyphicon-calendar"></span>{:date('Y-m-d',$article['create_time'])}</a></li>
            <li class="hidden"><a><span class="glyphicon glyphicon-eye-open"></span>1440</a></li>
            <li class="pull-right"><a href="javascript:void(0);"><span class="glyphicon glyphicon-user"></span> {$article['realname']}</a></li>
        </ol>
        <div id="article">
            <div class="article-title"><h1>{$article['title']}</h1></div>
            <div class="article-tags"><?php $tags = explode('，', $article['tags']);?>
                <?php $num=1; foreach($tags as $key=>$value){ ?>
                    <a href="{:U('tag/'.$value)}">
                        <span class="label label-vmaig-{$num} btn">{$value}</span>
                    </a>
                    <?php $num ++; if($num>6){break;}} ?>
            </div>
            <hr/>
            <div class="article-content">
                {:htmlspecialchars_decode($article['content'])}
            </div>
        </div>
    </div>
    <!--评论框 -->
    <div id="anchor-quote"></div>
    <div class="well hidden">
        <div class="vmaig-comment">
            <div class="vmaig-comment-tx">
                <img src="images/tx-default.jpg" width="40">
            </div>
            <div class="vmaig-comment-edit clearfix">
                <form id="vmaig-comment-form" method="post" role="form">
                    <input type='hidden' name='csrfmiddlewaretoken' value='1wmdmFVrEsVmuNyiwCSmhtzvvUgKlgF4'/>
                    <textarea id="comment" name="comment" class="form-control" rows="4"
                              placeholder="请输入评论 限200字!"></textarea>
                    <button type="submit" class="btn btn-vmaig-comments pull-right">提交</button>
                </form>
            </div>
            <ul>

                <li>
                    <div class="vmaig-comment-tx">
                        <img src=images/default.jpg width="40">
                    </div>
                    <div class="vmaig-comment-content">
                        <a><h1>ganxie_blog</h1></a>
                        <p></p>
                        <p>评论：测试</p>
                        <p>2015-12-24 23:15:04 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a class='quote' href="#anchor-quote" onclick="return CommentQuote('ganxie_blog',75);">回复</a>
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

</div>
<script type="text/javascript" src="__PUBLIC__/Home/js/vmaig.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shCore.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushCpp.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushJava.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushPython.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushXml.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushPowerShell.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/shBrushJScript.js"></script>
