
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">文章列表</a></li>
        <li ><a href="{:U('Article/Site/add')}">文章添加</a></li>
    </ul>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>文章名称</th>
            <th>状态</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['id']}</td>
                <td>{$value['title']}</td>
                <td>
                    <if condition="$value['status'] eq 1">
                        <font color="red">√</font>
                        <else/>
                        <font color="red">╳</font>
                    </if>
                </td>
                <td>
                    <a href="{:U('Article/Site/show',array('id'=>$value['id']))}">查看</a> |
                    <a href="{:U('Article/Site/save',array('id'=>$value['id']))}">修改</a> |
                    <a href="{:U('Article/Site/del',array('id'=>$value['id']))}">删除</a>
                </td>
            </tr>
        </foreach>
        <tbody>
        </tbody>
    </table>
    <div class="manu">{$page}</div>
</div>