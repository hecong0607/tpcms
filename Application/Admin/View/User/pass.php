<div class="wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="javascript:void(0);">密码修改</a></li>
	</ul>
	<form method="post" class="form-horizontal js-ajax-form" action="{:U('Admin/User/setPass')}">
		<fieldset>
			<div class="control-group">
				<label class="control-label">原始密码：</label>
				<div class="controls">
					<input type="password" name="oldPass"  id="oldPass"/>
					<span class="form-required"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">新密码：</label>
				<div class="controls">
					<input type="password" name="newPass"  id="newPass"/>
					<span class="form-required"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">重复新密码：</label>
				<div class="controls">
					<input type="password" name="againPass"  id="againPass"/>
					<span class="form-required"></span>
				</div>
			</div>

		</fieldset>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary js-ajax-submit">保存</button>
		</div>
	</form>
</div>