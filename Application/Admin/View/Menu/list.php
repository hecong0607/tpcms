<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="javascript:void(0);">菜单列表</a></li>
        <li><a href="{:U('Admin/Menu/add')}">菜单添加</a></li>
    </ul>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th width="50">序号</th>
            <th>图标-菜单名称</th>
            <th>路由</th>
            <th>类型</th>
            <th width="150">排序</th>
            <th width="120">操作</th>
        </tr>
        </thead>
        <?php $num = 1; ?>
        <foreach name="list" item="value">
            <tr>
                <td id="{$value['id']}">{$num++}</td>
                <td>{$value['left']}<i class="fa fa-{$value['logo']} normal"></i>&nbsp;&nbsp;{$value['menu_name']}</td>
                <td>{$value['route']}</td>
                <td><?= ($value['type'] == 0) ? '菜单' : (($value['type'] == 1) ? '菜单+权限' : '权限'); ?></td>
                <td>{$value['list_order']}</td>
                <td>
                    <a href="{:U('Admin/Menu/show',array('id'=>$value['id']))}">查看</a> |
                    <a href="{:U('Admin/Menu/save',array('id'=>$value['id']))}">编辑</a> |
                    <a href="{:U('Admin/Menu/del',array('id'=>$value['id']))}">删除</a>
                </td>
            </tr>
        </foreach>
        <tbody>
        </tbody>
    </table>
</div>