<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="javascript:void(0);">菜单列表</a></li>
		<li><a href="{:U('Admin/Menu/add')}">菜单添加</a></li>
	</ul>
	<table class="table table-hover table-bordered">
		<thead>
		<tr>
			<th width="50">ID</th>
			<th>图标-菜单名称</th>
			<th>模块</th>
			<th>控制器</th>
			<th>方法</th>
			<th>类型</th>
			<th>状态</th>
			<th width="150">列表显示排序（高到底）</th>
			<th>等级</th>
			<th width="120">操作</th>
		</tr>
		</thead>
		<foreach name="list" item="value">
			<tr>
				<td>{$value['id']}</td>
				<td><i class="fa fa-{$value['logo']} normal"></i> {$value['menu_name']}</td>
				<td>{$value['module']}</td>
				<td>{$value['controller']}</td>
				<td>{$value['action']}</td>
				<td>
					<if condition="$value['type']==1">
						菜单
					<else/>
						菜单+权限
					</if>
				</td>
				<td>
					<if condition="$value['status']==1">
						显示
					<else/>
						隐藏
					</if>
				</td>
				<td>{$value['list_order']}</td>
				<td>{$value['level']}</td>
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
	<div class="manu">{$page}</div>
</div>