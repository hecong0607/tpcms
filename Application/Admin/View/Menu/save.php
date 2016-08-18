<div class="wrap">
	<ul class="nav nav-tabs">
		<li><a href="{:U('Admin/Menu/list')}">菜单列表</a></li>
		<if condition="empty($data['id'])">
			<li class="active"><a href="javascript:void(0);">菜单添加</a></li>
		<else/>
			<li ><a href="{:U('Admin/Menu/save')}">菜单添加</a></li>
			<li class="active"><a href="javascript:void(0);">菜单编辑</a></li>
		</if>

	</ul>
	<form method="post" class="form-horizontal js-ajax-form" action="{:U('Admin/Menu/doSave')}">
		<fieldset>
			<div class="control-group">
				<label class="control-label">上级：</label>
				<div class="controls">
					<select name="parent_id">
						<option vlaue="0" >作为一级菜单</option>
						<foreach name="menu" item="v">
							<if condition="$v['id']!=$data['id']">
								<option value="{$v['id']}" <?= $data['parent_id']==$v['id']?'selected':'';?>>{$v.menu_name}</option>
							</if>
						</foreach>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">菜单名称：</label>
				<div class="controls">
					<input type="text" name="menu_name"  value="{$data['menu_name']}">
					<span class="form-required">*</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">模块：</label>
				<div class="controls">
					<input type="text" name="module" value="{$data['module']}">
					<span class="form-required">*</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">控制器：</label>
				<div class="controls">
					<input type="text" name="controller" value="{$data['controller']}">
					<span class="form-required">*</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">方法：</label>
				<div class="controls">
					<input type="text" name="action" value="{$data['action']}">
					<span class="form-required">*</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">图标：</label>
				<div class="controls">
					<input type="text" name="logo" value="{$data['logo']}">
					<a target="_blank" href="{:U('Admin/Menu/icons')}">选择图标</a>
					<span> 不带前缀fa-，如fa-user => user</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">备注：</label>
				<div class="controls">
					<input type="text" name="remark" value="{$data['remark']}">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">状态：</label>
				<div class="controls">
					<select name="status">
						<option value="1" <?=$data['status']==1?'selected':'';?> >显示</option>
						<option value="0" <?=$data['status']==='0'?'selected':'';?> >隐藏</option>
					</select>
					<span>侧边栏菜单是否显示</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">类型：</label>
				<div class="controls">
					<select name="type">
						<option value="1" <?=$data['type']==1?'selected':'';?>>菜单</option>
						<option value="0" <?=$data['type']==='0'?'selected':'';?> >菜单+权限</option>
					</select>
					<span>注意：“权限认证+菜单”表示加入后台权限管理，纯碎是菜单项请不要选择此项。</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">列表排序：</label>
				<div class="controls">
					<input type="text" name="list_order" value="{$data['list_order']}">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">等级：</label>
				<div class="controls">
					<select name="level">
						<option value="1" <?=$data['level']==1?'selected':'';?>>1</option>
						<option value="2" <?=$data['level']==2?'selected':'';?>>2</option>
						<option value="3" <?=$data['level']==3?'selected':'';?>>3</option>
						<option value="4" <?=$data['level']==4?'selected':'';?>>4</option>
						<option value="5" <?=$data['level']==5?'selected':'';?>>5</option>
					</select>
				</div>
			</div>
		</fieldset>
		<div class="form-actions">
			<input type="hidden" name="id" value="{$data['id']}"/>
			<button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
			<button class="btn js-ajax-close-btn" type="submit">关闭</button>
		</div>
	</form>
	<script>

		$(function() {
			$(".js-ajax-close-btn").on('click', function(e) {
				e.preventDefault();
				Wind.use("artDialog", function() {
					art.dialog({
						id : "question",
						icon : "question",
						fixed : true,
						lock : true,
						background : "#CCCCCC",
						opacity : 0,
						content : "您确定需要关闭当前页面嘛？",
						ok : function() {
							setCookie('Admin_Menu', 1);
							window.close();
							return true;
						}
					});
				});
			});
		});

	</script>
</div>