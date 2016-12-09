<div class="fullbox" id="post- ">
    <div class="fullbox_header"></div>
    <div class="fullbox_content">
        <div class="breadcrumb">
            <a href="/">首页</a>
            <img src="__PUBLIC__/blog/images/arrow.png" alt="">
            <a href="{:U('/Blog/')}">博客</a>
            <img src="__PUBLIC__/blog/images/arrow.png" alt="">
            <a href="{:U('/Blog/Section/'.$article['section_id'])}">{$article['name']}</a>
            <img src="__PUBLIC__/blog/images/arrow.png" alt="">
            <a href="{:U('/Blog/Article/'.$article['id'])}">{$article['title']}</a>
        </div>
        <h1><a href="{:U('/Blog/Article/'.$article['id'])}" rel="bookmark">{$article['title']}</a></h1>
        <span class="vicetitle" style="display: none;">副标题</span>

        <div class="post_info">
            <div class="post_info_left">在 {:date('Y年m月d日',$article['create_time'])} 那天写的 &nbsp;&nbsp;&nbsp; 已经有 {$article['view']} 次阅读了</div>
            <div class="post_info_right">
                <!-- <a href="#respond" class="post_comment"></a> -->
                感谢 <a href="{:U('/Blog/Article/'.$article['id'])}">参考或原文</a></div>
        </div>
        <div class="post_meta"></div>

        <div class="post_content readmood" id="defend_3">
            {:htmlspecialchars_decode($article['content'])}
        </div>
        <div class="wrn">
            <div class="wrnleft"><img src="__PUBLIC__/blog/images/wrn.jpg"></div>
            <div class="wrnright">
                <p>转载随意，但请带上本文地址：</p>

                <p><a href="{:U('/Blog/Article/'.$article['id'],'',true,true)}">{:U('/Blog/Article/'.$article['id'],'',true,true)}</a>
                </p>
            </div>
            <div class="clear"></div>
        </div>

        <div class="tips">
            <div>小提示：您可以按快捷键 Ctrl + D，加入收藏</div>
        </div>

    </div>
    <div class="fullbox_footer"></div>
</div>