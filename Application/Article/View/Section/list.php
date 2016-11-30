<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">栏目列表</a></li>
        <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
    </ul>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>栏目名称</th>
            <th width="180">已发布文章</th>
            <th width="120">创建时间</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <?php $article = new \Article\Model\ArticleModel();?>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['name']}</td>
                <td><?=$article->getCountBySection($value['id']);?></td>
                <td>{:date('Y-m-d H:i',$value['create_time'])}</td>
                <td>
                    <a href="{:U('Article/Section/show',array('id'=>$value['id']))}">查看</a>
                </td>
            </tr>
        </foreach>
        <tbody>
        </tbody>
    </table>
    <div class="manu">{$page}</div>
</div>