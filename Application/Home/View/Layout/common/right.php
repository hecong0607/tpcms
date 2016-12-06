<!-- 右边的widgets -->
<div id="vmaig-side" class="col-md-4 col-lg-3 hidden-xs">
    <div id="tags_cloud" class="">
    </div>
    <style>
        #tags_cloud {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
    <script src="__PUBLIC__/Home/js/d3.js"></script>
    <script src="__PUBLIC__/Home/js/d3.layout.cloud.js"></script>
    <script>
        var fill = d3.scale.category20();
        //在tags数组中存放blog的tags,用于在标签云中显示
        <?php $tags = new \Article\Model\ArticleTagsModel();$data = $tags->getHomeData();?>
        var tags = [<?=$data;?>];
        var words = tags.concat(tags).concat(tags);

        d3.layout.cloud().size([250, 250])
            .words(words.map(function (d) {
                return {text: d, size: 10 + Math.random() * 25};
            }))
            .padding(5)
            .rotate(function () {
                return ~~(Math.random() * 2) * 90;
            })
            .font("Helvetica, arial, nimbussansl, liberationsans, freesans, clean, sans-serif, 'Segoe UI Emoji', 'Segoe UI Symbol'")
            .fontSize(function (d) {
                return d.size;
            })
            .on("end", draw)
            .start();
        function draw(words) {
            d3.select("#tags_cloud").append("svg")
                .attr("width", 250)
                .attr("height", 250)
                .append("g")
                .attr("transform", "translate(125,125)");
            for (var i = 0; i < words.length; ++i) {
                var str = words[i];
                d3.select("g").append("a").attr("xlink:href", "/tag/" + words[i].text + ".html")
                    .append("text").text(words[i].text).style("font-size", words[i].size + "px")
                    .style("font-family", "'Microsoft YaHei','WenQuanYi Micro Hei','tohoma,sans-serif'")
                    .style("fill", fill(i))
                    .attr("text-anchor", "middle")
                    .attr("transform",
                    "translate(" + [words[i].x, words[i].y] + ")rotate(" + words[i].rotate + ")"
                )
            }
        }
    </script>
    <div id="vmaig-search" class="hidden">
        <div class="search">
            <form class="form-inline clearfix" role="form" method="get" action="javascript:void(0);">
                <input type="text" class="form-control" id="s" name="s">
                <button class="btn btn-vmaig">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>
        </div>
    </div>

    <div id="vmaig-hotest-posts">
        <div class="panel panel-vmaig">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-flag"></span>
                    热门文章
                    <span class="glyphicon glyphicon-remove btn panel-close pull-right"></span>
                                <span class="glyphicon glyphicon-chevron-up btn panel-collapse pull-right"
                                      data-toggle="collapse" data-target="#hotest-post-list"></span>
                </h3>
            </div>
            <ul id="hotest-post-list" class="list-group collapse in">
                <li class="list-group-item">
                    <span class="hotest-post-title"><a href="javascript:void(0);">本网站</a> </span>
                    <span class="badge">6139</span>
                </li>
            </ul>
        </div>
    </div>
    <div id="vmaig-latest-comments" class="hidden">
        <div class="panel panel-vmaig-comments">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-comment"></span>
                    最新评论
                                <span class="glyphicon glyphicon-remove btn panel-close pull-right"
                                      data-dismiss="alert"></span>
                                <span class="glyphicon glyphicon-chevron-up btn panel-collapse pull-right"
                                      data-toggle="collapse" data-target="#latest-comment-list"></span>
                </h3>
            </div>
            <ul id="latest-comment-list" class="list-group collapse in">
                <li class="list-group-item clearfix">
                    <div class="comment-tx">
                        <img src="__PUBLIC__/Home/images/default.jpg" width="40" height="40" alt="">
                    </div>
                    <div class="comment-info">
                        <div class="comment-username">
                            <a href="javascript:void(0);">xx 评论:</a>
                        </div>
                        <div class="comment-content">
                            <a href="javascript:void(0);">这</a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
    <div id="vmaig-links">
        <div class="panel panel-vmaig">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-link"></span>
                    友情链接
                    <span class="glyphicon glyphicon-remove btn panel-close pull-right"></span>
                                <span class="glyphicon glyphicon-chevron-up btn panel-collapse pull-right"
                                      data-toggle="collapse" data-target="#links"></span>
                </h3>
            </div>
            <div id="links" class="padding10 list-group collapse in">

                <a title="the5fire" target="_blank" href="http://www.the5fire.com"
                   class="btn btn-xs btn-primary">the5fire</a>

                <a title="简明现代魔法" target="_blank" href="http://www.nowamagic.net"
                   class="btn btn-xs btn-success">简明现代魔法</a>

                <a title="玩蛇网Python论坛" target="_blank" href="http://bbs.iplaypython.com"
                   class="btn btn-xs btn-info">玩蛇网Python论坛</a>

                <a title="Anotherhome" target="_blank" href="https://www.anotherhome.net/"
                   class="btn btn-xs btn-warning">Anotherhome</a>

            </div>
        </div>
    </div>
</div>