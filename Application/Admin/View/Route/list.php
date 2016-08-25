<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="javascript:void(0);">路由列表</a></li>
	</ul>
	<div class="row-fluid">
		<div class="span5" style="text-align: center;">
			<select size="20" multiple="multiple"  style="height: auto;width: 100%;">
				<foreach name="program" item="value">
					<option >{$value}</option>
				</foreach>
			</select>
		</div>
		<div class="span1" style="text-align: center;">
			<br><br>
			<a class="btn btn-success btn-assign" href="javascript:void(0);" title="Assign" data-target="avaliable">&gt;&gt;
				<i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display: none;"></i></a><br><br>
			<a class="btn btn-danger btn-assign" href="javascript:void(0);" title="Remove" data-target="assigned">&lt;&lt;
				<i class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display: none;"></i></a></div>
		<div class="span5" style="text-align: center;">
			<select size="20" multiple="multiple" style="height: auto;width: 100%;">
				<foreach name="database" item="value">
					<option data-id="{$value['id']}">{$value['route']}</option>
				</foreach>
			</select>
		</div>
	</div>
</div>