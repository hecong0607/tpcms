<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">角色列表</a></li>
        <li><a href="{:U('Admin/Role/add')}">角色添加</a></li>
    </ul>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>角色名称</th>
            <th>角色描述</th>
            <th>状态</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['id']}</td>
                <td>{$value['name']}</td>
                <td>{$value['remark']}</td>
                <td>
                    <if condition="$value['status'] eq 1">
                        <font color="red">√</font>
                        <else/>
                        <font color="red">╳</font>
                    </if>
                </td>
                <td>
                    <if condition="$value['id'] eq 1">
                        <font color="#cccccc">查看</font>|
                        <font color="#cccccc">权限设置</font>|
                        <font color="#cccccc">修改</font> |
                        <font color="#cccccc">删除</font>
                        <else/>
                        <a href="{:U('Admin/Role/show',array('id'=>$value['id']))}">查看</a> |
                        <a href="{:U('Admin/Role/setPower',array('id'=>$value['id']))}">权限设置</a> |
                        <a href="{:U('Admin/Role/save',array('id'=>$value['id']))}">修改</a> |
                        <a href="{:U('Admin/Role/del',array('id'=>$value['id']))}">删除</a>
                    </if>
                </td>
            </tr>
        </foreach>
        <tbody>
        </tbody>
    </table>
    <div class="manu">{$page}</div>
</div>