<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">管理员列表</a></li>
        <li><a href="{:U('Admin/User/add')}">管理员添加</a></li>
    </ul>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">ID</th>
            <th>用户名</th>
            <th>角色</th>
            <th>电话</th>
            <th>邮箱</th>
            <th>最后登录IP</th>
            <th>最后登录时间</th>
            <th>状态</th>
            <th width="180">操作</th>
        </tr>
        </thead>
        <foreach name="list" item="value">
            <tr>
                <td>{$value['id']}</td>
                <td>{$value['username']}</td>
                <td>{$value['name']}</td>
                <td>{$value['phone']}</td>
                <td>{$value['email']}</td>
                <td>{$value['last_ip']}</td>
                <td>{:date('Y-m-d H:i:s',$value['last_time'])}</td>
                <td>
                    <if condition="$value['status'] eq 1">
                        正常
                        <else/>
                        已拉黑
                    </if>
                </td>
                <td>
                    <if condition="$value['id'] eq 1">
                        <font color="#cccccc">编辑</font>|
                        <font color="#cccccc">删除</font>|
                        <font color="#cccccc">拉黑</font>
                        <else/>
                        <a href="{:U('Admin/User/save',array('id'=>$value['id']))}">编辑</a> |
                        <a href="{:U('Admin/User/del',array('id'=>$value['id']))}">删除</a> |
                        <if condition="$value['status'] eq 1">
                            <a href="{:U('Admin/User/setBlack',array('id'=>$value['id']))}">拉黑</a>
                            <else/>
                            <a href="{:U('Admin/User/setEnable',array('id'=>$value['id']))}">启用</a>
                        </if>
                    </if>
                </td>
            </tr>
        </foreach>
        <tbody>
        </tbody>
    </table>
    <div class="manu">{$page}</div>
</div>