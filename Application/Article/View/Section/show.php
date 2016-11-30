
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="{:U('Article/Section/list')}">栏目列表</a>
        <li><a href="{:U('Article/Section/add')}">栏目添加</a></li>
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
            </table>
        </div>
    </div>
</div>
