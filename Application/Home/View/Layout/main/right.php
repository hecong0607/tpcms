<div id="sidebar" class="clearfix">
    <div id="sidebar-inner">
        <?php $articleModel = new \Blog\Model\ArticleModel();$home_right = $articleModel->getHomeRight()->data; foreach($home_right as $k => $v){ ?>
        <div class="sidebar-section-wrapper">
            <div class="sidebar-section">
                <h2 class="sidebar-title">{$v['title']}</h2>
                <div class="sidebar-content">
                    <div class="web_intro">{:htmlspecialchars_decode($v['content'])}</div>
                </div>
            </div>
        </div>
        <?php } ?>

        <div class="sidebar-section-wrapper">
            <div class="sidebar-section">
                <h2 class="sidebar-title">热门博文</h2>

                <div class="sidebar-content">
                    <ul><?php $popular_right = clone $articleModel->getPopular(); foreach($popular_right->data as $key=>$value){ ?>
                        <li class="clearfix"><a href="{:U('/Blog/Article/'.$value['id'])}" target="_blank">{$value['title']}</a>
                            <span>{$value['view']} views</span></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <div id="category-nav" class="sidebar-section-wrapper">
            <div class="sidebar-section">
                <h2 class="sidebar-title">推荐</h2>

                <div class="sidebar-content">
                    <ul class="clearfix"><?php $recommend_right = clone $articleModel->getRecommend(); foreach($recommend_right->data as $k=>$v){ ?>
                        <li style="line-height:200%"><a href="{:U('/Blog/Article/'.$v['id'])}" target="_blank">{$v['title']}</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>