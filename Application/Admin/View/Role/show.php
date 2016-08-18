<div class="wrap">
	<ul class="nav nav-tabs">
		<li><a href="{:U('Admin/Role/list')}">角色列表</a></li>
		<li ><a href="{:U('Admin/Role/save')}">角色添加</a></li>
		<li class="active"><a href="javascript:void(0);">角色详情</a></li>
	</ul>
	<div class="form-horizontal">
		<fieldset>
			<div class="control-group">
				<label class="control-label">角色名称:</label>
				<div class="controls">{$data['name']}</div>
			</div>
			<div class="control-group">
				<label class="control-label">角色描述:</label>
				<div class="controls">{$data['remark']}</div>
			</div>
			<div class="control-group">
				<label class="control-label">状态:</label>
				<div class="controls">
					<if condition="$data['status']==1">
						开启
					<else/>
						禁用
					</if>
				</div>
			</div>
		</fieldset>
	</div>
</div>