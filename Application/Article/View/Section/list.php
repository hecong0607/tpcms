<style type="text/css">
    .thumb{width: 50px;height: auto;max-height: 50px;}
</style>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">栏目列表</a></li>
        <?php if($admin==1){ ?>
        <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
        <?php } ?>
    </ul>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th >栏目名称</th>
            <th width="50">封面</th>
            <th width="50">排序</th>
            <th width="80">已发布文章</th>
            <th width="120">创建时间</th>
            <th width="60">发布</th>
            <th width="60">类型</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <?php if(!empty($list)){ ?>
        <?php $article = new \Article\Model\ArticleModel();?>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['left']}{$value['name']}</td>
                <td><img class="thumb"  src="{$value['thumb']}"></td>
                <td>{$value['list_order']}</td>
                <td><?=$article->getCountBySection($value['id']);?></td>
                <td>{:date('Y-m-d H:i',$value['create_time'])}</td>
                <td>
                    <if condition="$value['status'] eq 1">
                        <font color="red">√</font>
                        <else/>
                        <font color="red">╳</font>
                    </if>
                </td>
                <td>
                    <if condition="$value['type'] eq 1">图片<else/>文章</if>
                </td>
                <td>
                    <?php if($admin==1){ ?>
                    <a href="{:U('Article/Section/showAdmin',array('id'=>$value['id']))}">查看</a>
                    | <a href="{:U('Article/Section/save',array('id'=>$value['id']))}">修改</a>
                    | <a class="js-ajax-delete" href="{:U('Article/Section/del',array('id'=>$value['id']))}">删除</a>
                    <?php } else { ?>
                        <a href="{:U('Article/Section/show',array('id'=>$value['id']))}">查看</a>
                    <?php } ?>
                </td>
            </tr>
        </foreach>
        <?php } else { ?>
            <tr><td colspan="4">暂无信息</td></tr>
        <?php } ?>
        <tbody>
        </tbody>
    </table>
</div>