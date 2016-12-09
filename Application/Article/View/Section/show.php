<style type="text/css">
    .thumb{width: 200px;height: auto;max-height: 200px;}
</style>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <?php if($admin==1){ ?>
            <li><a href="{:U('Article/Section/listAdmin')}">栏目列表</a>
            <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
        <?php } else {  ?>
            <li><a href="{:U('Article/Section/list')}">栏目列表</a>
        <?php } ?>
        <li class="active"><a href="javascript:void(0);">栏目详情</a></li>
    </ul>
    <div class="row-fluid">
        <div class="span9">
            <table class="table table-bordered">
                <tr>
                    <th width="80">栏目名称</th>
                    <td>{$data['name']}</td>
                </tr>
                <tr>
                    <th>内容</th>
                    <td>{:htmlspecialchars_decode($data['content'])}</td>
                </tr>
                <tr>
                    <th>封面</th>
                    <td><img class="thumb"  src="{$data['face']}"></td>
                </tr>
                <tr>
                    <th>发布</th>
                    <td> <if condition="$data['status'] eq 1">是<else/>否</if></td>
                </tr>
                <tr>
                    <th>排序</th>
                    <td>{$data['list_order']}</td>
                </tr>
                <tr>
                    <th>类型</th>
                    <td><if condition="$data['status'] eq 1">图片<else/>文章</if></td>
                </tr>
            </table>
        </div>
    </div>
</div>
