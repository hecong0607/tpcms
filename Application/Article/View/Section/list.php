<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">栏目列表</a></li>
        <?php if($admin==1){ ?>
        <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
        <?php } ?>
    </ul>
    <form class="well form-search" method="get" action="">
        栏目名称：
        <input type="text" name="name" style="width: 200px;" value="{$_GET['name']}" placeholder="请输入栏目名称...">
        <input type="submit" class="btn btn-primary" value="搜索">
    </form>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th >栏目名称</th>
            <th width="180">已发布文章</th>
            <th width="120">创建时间</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <?php if(!empty($list)){ ?>
        <?php $article = new \Article\Model\ArticleModel();?>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['name']}</td>
                <td><?=$article->getCountBySection($value['id']);?></td>
                <td>{:date('Y-m-d H:i',$value['create_time'])}</td>
                <td>
                    <a href="{:U('Article/Section/show',array('id'=>$value['id']))}">查看</a>
                    <?php if($admin==1){ ?>
                    | <a href="{:U('Article/Section/save',array('id'=>$value['id']))}">修改</a>
                    | <a href="{:U('Article/Section/del',array('id'=>$value['id']))}">删除</a>
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
    <div class="manu">{$page}</div>
</div>